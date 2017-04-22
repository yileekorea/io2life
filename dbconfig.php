<?php
class Database
{
     
	
    private $host = "iot2ym.iptime.org";
    private $db_name = "dbtest";
    private $username = "yilee";
    private $password = "1234";
	
	//IF $mailServerType = 'smtp'
	public $smtp_server = 'smtp.gmail.com';
	public $smtp_user = 'systemmmt2@gmail.com';
	public $smtp_pw = 'lip90509071';
	public $smtp_port = 465; //465 for ssl, 587 for tls, 25 for other
	public $smtp_security = 'ssl';//ssl, tls or ''

    public $conn;

    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>