<?php
class Database
{
/*
    private $host = "iot2better.iptime.org";
    private $db_name = "io2db";
    private $username = "root";
    private $password = "systemmmt";    
	private $port = "3386";


    private $host = "db.io2life.com";
    private $db_name = "dbio2life";
    private $username = "io2life";
    private $password = "lip905090&1";    
*/
//    private $host = "io2better.net";
    //private $host = "io2better.net";
    //private $host = "222.121.101.84";
	private $host = "192.168.30.30";
    private $db_name = "io2db";
    private $username = "root";
    private $password = "systemmmt";
	private $port = "3386";
	
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
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
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