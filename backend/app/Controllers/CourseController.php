<?php

require_once __DIR__ . '/../../configs/database.php';

class CourseController {
   private $db;

   public function __construct()
   {
      $this->db = DatabaseConnection::getInstance();
   }

   public function index()
   {
      $courses = $this->db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($courses);
   }

   public function store()
   {
      $dataFromRequest = json_decode(file_get_contents("php://input"), true);
      $newCourse = $this->db->prepare("INSERT INTO courses (title, description) VALUES (:title, :description)");
      $newCourse->bindParam(':title', $dataFromRequest['title']);
      $newCourse->bindParam(':description', $dataFromRequest['description']);
      $newCourse->execute();

      $lastInsertId = $this->db->lastInsertId();
      $course = $this->db
         ->query("SELECT * FROM courses WHERE id = $lastInsertId")
         ->fetchAll(PDO::FETCH_ASSOC);

      http_response_code(201);
      echo json_encode($course, JSON_PRETTY_PRINT);
   }

   public function show(int $id)
   {
      try {
         $course = $this->_findOrFail($this->db, 'courses', $id);
         echo json_encode($course, JSON_PRETTY_PRINT);
      } catch (Exception $e) {
         http_response_code(404);
         echo json_encode(['error' => [
            'message' => $e->getMessage(),
            'file' => $e->getTrace()[1]['class'],
            'line' => $e->getLine()
         ]]);
      }
   }

   public function update(int $id)
   {
      try {
         $course = $this->_findOrFail($this->db, 'courses', $id);

         $dataFromRequest = json_decode(file_get_contents("php://input"), true);
         $updateCourse = $this->db->prepare(
            "UPDATE courses SET title = :title, description = :description WHERE id = :id"
         );
         $updateCourse->bindParam(':title', $dataFromRequest['title']);
         $updateCourse->bindParam(':description', $dataFromRequest['description']);
         $updateCourse->bindParam(':id', $id);
         $updateCourse->execute();

         $course = $this->db
            ->query("SELECT * FROM courses WHERE id = $id")
            ->fetch(PDO::FETCH_ASSOC);

         echo json_encode($course, JSON_PRETTY_PRINT);
      } catch (Exception $e) {
         http_response_code(404);
         echo json_encode(['error' => [
            'message' => $e->getMessage(),
            'file' => $e->getTrace()[1]['class'],
            'line' => $e->getLine()
         ]]);
      }
   }
   
   public function destroy(int $id)
   {
      try {
         $this->_findOrFail($this->db, 'courses', $id);

         $this->db->query("DELETE FROM courses where id = $id");  
      } catch (Exception $e) {
         http_response_code(404);
         echo json_encode(['error' => [
            'message' => $e->getMessage(),
            'file' => $e->getTrace()[1]['class'],
            'line' => $e->getLine()
         ]]);
      }
   }

   private function _findOrFail(PDO $db, string $table, int $id) {
      $stmt = $db->prepare("SELECT * FROM {$table} WHERE id = :id LIMIT 1");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if (!$record) {
          throw new Exception("Course not Found");
      }
      
      return $record;
  }
}