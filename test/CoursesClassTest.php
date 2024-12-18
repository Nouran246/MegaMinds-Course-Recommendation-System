<?php
use PHPUnit\Framework\TestCase;

class CourseClassTest extends TestCase
{
    private $mockPdo;
    private $mockDbConnection;

    protected function setUp(): void
    {
        // Mock PDO connection
        $this->mockPdo = $this->createMock(PDO::class);
    }

    public function testAddCourse()
    {
        // Mock global variables for database connection
        $GLOBALS['conn'] = $this->createMock(mysqli::class);

        // Mock input data for adding a course
        $_POST = [
            'course_name' => 'Test Course',
            'description' => 'This is a test description.',
            'level' => 'Beginner',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'rating' => '4.5',
            'fees' => '100',
            'tags' => 'test,php,course'
        ];

        // Mock file upload
        $_FILES = [
            'image' => [
                'tmp_name' => '/tmp/test-image.jpg',
                'error' => UPLOAD_ERR_OK,
                'type' => 'image/jpeg',
                'size' => 1024 // 1 KB
            ]
        ];

        // Simulate query for checking existing course name
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->expects($this->once())
            ->method('num_rows')
            ->willReturn(0);

        $GLOBALS['conn']->expects($this->once())
            ->method('query')
            ->with($this->stringContains("SELECT * FROM courses WHERE course_name ="))
            ->willReturn($mockResult);

        // Simulate query for inserting new course
        $GLOBALS['conn']->expects($this->once())
            ->method('query')
            ->with($this->stringContains("INSERT INTO courses"))
            ->willReturn(true);

        // Call the AddCourse static method
        ob_start();
        Course::AddCourse($_POST['course_name'], $_POST['description'], $_POST['level'], $_POST['start_date'], $_POST['end_date'], $_POST['rating'], $_POST['fees'], $_POST['tags'], $_FILES['image']);
        $output = ob_get_clean();

        // Assert no errors were output
        $this->assertStringNotContainsString('Error', $output);
    }

    public function testDeleteCourse()
    {
        // Mock PDO connection
        $pdo = $this->createMock(PDO::class);

        // Mock deleteCourse behavior
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $pdo->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('DELETE FROM courses'))
            ->willReturn($stmt);

        // Replace the database connection inside the Course class
        $courseClass = new Course();
        $courseClass->pdo = $pdo;

        // Call deleteCourse and assert the response
        $response = $courseClass->deleteCourse(1);
        $decodedResponse = json_decode($response, true);

        $this->assertEquals('success', $decodedResponse['status']);
        $this->assertEquals('Course deleted successfully.', $decodedResponse['message']);
    }

    public function testEditCourse()
    {
        // Mock PDO connection
        $pdo = $this->createMock(PDO::class);

        // Mock update query
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $pdo->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('UPDATE courses'))
            ->willReturn($stmt);

        // Replace the database connection inside the Course class
        $courseClass = new Course();
        $courseClass->pdo = $pdo;

        // Mock POST data
        $_POST = [
            'course_ID' => 1,
            'course_name' => 'Updated Test Course',
            'description' => 'Updated description.',
            'level' => 'Intermediate',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'rating' => '4.8',
            'fees' => '150',
            'tags' => 'updated,php,course'
        ];

        // Call editCourse and assert the response
        ob_start();
        Course::editCourse();
        $output = ob_get_clean();

        $decodedResponse = json_decode($output, true);

        $this->assertEquals('success', $decodedResponse['status']);
        $this->assertEquals('Course updated successfully', $decodedResponse['message']);
    }
}
