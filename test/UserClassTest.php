<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase; // Import PHPUnit's TestCase class

require_once __DIR__ . '/../App/Model/UserClass.php'; // Adjust the path as needed

class UserClassTest extends TestCase
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

    // Create a mock of the mysqli connection
    $mockConn = $this->getMockBuilder(mysqli::class)
                     ->disableOriginalConstructor()
                     ->getMock();

    // Create a mock of the mysqli_result object
    $mockResult = $this->createMock(mysqli_result::class);

    // Mock the query method of the connection to return the mock result
    $mockConn->expects($this->once())
             ->method('query')
             ->with($this->stringContains('SELECT')) // Optionally, you can check the query
             ->willReturn($mockResult);

    // Simulate the behavior of num_rows by mocking the fetch_assoc method
    $mockResult->method('fetch_assoc')
               ->willReturn([
                   'ID' => 1,
                   'FName' => 'John',
                   'LName' => 'Doe',
                   'Password' => 'password123',
                   'usertype_id' => 1
               ]);

    // Mock num_rows using a separate method for the result count
    // Use the setReturnValueMap or any similar mechanism if needed for further methods.
    $mockResult->expects($this->once())
               ->method('mysqli_num_rows')
               ->willReturn(1); // Simulate that the query has one result

    // Mock the close method to prevent errors
    $mockConn->expects($this->any())
             ->method('close')
             ->willReturn(true); // Simulate a successful close

    // Now we can proceed with the test
    $loginHandler = new LoginHandler($mockConn);

    // Expect no output for a successful login
    $this->expectOutputString(""); 

    // Call the handle method with the test data
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

