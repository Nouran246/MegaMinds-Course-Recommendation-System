<?php

use PHPUnit\Framework\TestCase; // Import PHPUnit's TestCase class

require_once __DIR__ . '/../App/Model/UserClass.php'; // Adjust the path as needed

class UserTest extends TestCase
{
    private $mockDB;

    protected function setUp(): void
    {
        // Create a mock PDO instance for database interactions
        $this->mockDB = $this->getMockBuilder(PDO::class)
                             ->disableOriginalConstructor()
                             ->getMock();
    }

    public function testSignupHandler()
    {
        $data = [
            'FName' => 'John',
            'LName' => 'Doe',
            'Email' => 'john.doe@example.com',
            'Password' => 'password123'
        ];

        // Mock prepared statements for the database
        $stmt = $this->getMockBuilder(PDOStatement::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        // Expecting the query for checking if the email exists
        $this->mockDB->expects($this->any())
                     ->method('prepare')
                     ->willReturn($stmt);

        $stmt->expects($this->any())
             ->method('execute')
             ->willReturn(true);

        $stmt->expects($this->any())
             ->method('rowCount')
             ->willReturn(0);

        $signupHandler = new SignupHandler($this->mockDB);
        $this->expectOutputString(""); // No output expected for success
        $signupHandler->handle($data);
    }

    public function testLoginHandler()
    {
        $data = [
            'Email' => 'john.doe@example.com',
            'Password' => 'password123'
        ];

        $mockConn = $this->getMockBuilder(mysqli::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $GLOBALS['conn'] = $mockConn;

        // Simulating the result set
        $mockResult = $this->getMockBuilder(mysqli_result::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $mockResult->expects($this->any())
                   ->method('num_rows')
                   ->willReturn(1);

        $mockResult->expects($this->any())
                   ->method('fetch_assoc')
                   ->willReturn([
                       'ID' => 1,
                       'FName' => 'John',
                       'LName' => 'Doe',
                       'Password' => 'password123',
                       'usertype_id' => 1
                   ]);

        $mockConn->expects($this->any())
                 ->method('query')
                 ->willReturn($mockResult);

        $loginHandler = new LoginHandler($mockConn);
        $this->expectOutputString(""); // No output expected for success
        $loginHandler->handle($data);
    }

    public function testEditUserHandler()
    {
        $data = [
            'id' => 1,
            'FName' => 'Updated',
            'LName' => 'Name',
            'Email' => 'updated@example.com'
        ];

        $stmt = $this->getMockBuilder(PDOStatement::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $this->mockDB->expects($this->any())
                     ->method('prepare')
                     ->willReturn($stmt);

        $stmt->expects($this->any())
             ->method('execute')
             ->willReturn(true);

        $editUserHandler = new EditUserHandler($this->mockDB);
        $this->expectOutputString(json_encode(['status' => 'success', 'message' => 'User updated successfully']));
        $editUserHandler->handle($data);
    }

    public function testDeleteUserHandler()
    {
        $data = ['id' => 1];

        $stmt = $this->getMockBuilder(PDOStatement::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $this->mockDB->expects($this->any())
                     ->method('prepare')
                     ->willReturn($stmt);

        $stmt->expects($this->any())
             ->method('execute')
             ->willReturn(true);

        $deleteUserHandler = new DeleteUserHandler($this->mockDB);
        $this->expectOutputString(json_encode(['status' => 'success', 'message' => 'User deleted successfully']));
        $deleteUserHandler->handle($data);
    }

    public function testUpdateProfileHandler()
    {
        $data = [
            'id' => 1,
            'FName' => 'Updated',
            'LName' => 'Profile',
            'Email' => 'profile@example.com'
        ];

        $stmt = $this->getMockBuilder(PDOStatement::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $this->mockDB->expects($this->any())
                     ->method('prepare')
                     ->willReturn($stmt);

        $stmt->expects($this->any())
             ->method('execute')
             ->willReturn(true);

        $updateProfileHandler = new UpdateProfileHandler($this->mockDB);
        $this->expectOutputString(json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']));
        $updateProfileHandler->handle($data);
    }
}

