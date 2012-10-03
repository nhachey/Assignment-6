<?php
class CPU
{
    public function freeze() { /* ... */ }
    public function jump( $position ) { /* ... */ }
    public function execute() { /* ... */ }

}

class Memory
{
    public function load( $position, $data ) { /* ... */ }
}

class HardDrive
{
    public function read( $lba, $size ) { /* ... */ }
}

class NetworkDrive
{
     private $computerId;

     public function __construct($id)
     {
         $this->computerId = $id;
     }

     public function send() { echo $this->computerId; }

}

class Computer
{
    protected $cpu = null;
    protected $memory = null;
    protected $hardDrive = null;
    protected $networkDrive = null;
    private $id = 534;

    public function __construct()
    {
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hardDrive = new HardDrive();
        $this->networkDrive = new NetworkDrive($this->id);
    }

    public function startComputer()
    {
        $this->cpu->freeze();
        $this->memory->load( BOOT_ADDRESS, $this->hardDrive->read( BOOT_SECTOR, SECTOR_SIZE ) );
        $this->cpu->jump( BOOT_ADDRESS );
        $this->cpu->execute();
        $this->networkDrive->send();
    }
}

$facade = new Computer();
$facade->startComputer();
