<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 */
class Pedido
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var float
     */
    private $importe;
    
  //creo mis variables para definir las relaciones
    protected $usuario;
    protected $lineas_pedido;

	//constructor
	public function __construct(Usuario $usuario){
	$this->usuario = $usuario;
	$this->lineas_pedido = new ArrayCollection();
	$this->fecha = new DateTime(); // al declararla como DATETIME no sé si es así
	$this->importe = 0;
	}

	
	
	
	//método para obtener las líneas del pedido
	public function getLineas_pedido(){
	return $this->lineas_pedido;
	}
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Pedido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set importe
     *
     * @param float $importe
     * @return Pedido
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return float 
     */
    public function getImporte()
    {
        return $this->importe;
    }
}
