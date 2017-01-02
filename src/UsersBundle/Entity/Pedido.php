<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;

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
    
    private $fechaprocesado;
    private $estado;
    private $isdevolucion;
    private $etiqueta;
    
  //creo mis variables para definir las relaciones
    protected $usuario;
    protected $lineas_pedido;

	//constructor
	public function __construct(){
	//$this->usuario = $usuario;
	$this->lineas_pedido = new ArrayCollection();
	$this->importe = 0;
	$this->fechaprocesado = null;
	$this->estado = "Pendiente";
	$this->isdevolucion = false;
	$etiqueta = null;
	}
	
	public function sinDevoluciones(){
	$total = 0;
	for($i=0;$i<sizeof($this->lineas_pedido);$i++){
	if($this->lineas_pedido[$i]->getCantidadDevolver() != 0){
	$total++;
	}
	}
	return $total;
	}

	public function calcularImporte(){
	$total=0;
	for($i=0;$i<sizeof($this->lineas_pedido);$i++){
	$total = $total + $this->lineas_pedido[$i]->getImporte();
	}
	return $total;	
	}
	
	public function getFechaSalida(){
		return $this->fechaprocesado->format('d-m-Y');
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
        return $this->fecha->format('d-m-Y H:i');
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

    /**
     * Add lineas_pedido
     *
     * @param \UsersBundle\Entity\Linea_pedido $lineasPedido
     * @return Pedido
     */
    public function addLineasPedido(\UsersBundle\Entity\Linea_pedido $lineasPedido)
    {
        $this->lineas_pedido[] = $lineasPedido;

        return $this;
    }

    /**
     * Remove lineas_pedido
     *
     * @param \UsersBundle\Entity\Linea_pedido $lineasPedido
     */
    public function removeLineasPedido(\UsersBundle\Entity\Linea_pedido $lineasPedido)
    {
        $this->lineas_pedido->removeElement($lineasPedido);
    }

    /**
     * Get lineas_pedido
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLineasPedido()
    {
        return $this->lineas_pedido;
    }

    /**
     * Set usuario
     *
     * @param \UsersBundle\Entity\Usuario $usuario
     * @return Pedido
     */
    public function setUsuario(\UsersBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \UsersBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fecha_procesado
     *
     * @param string $fechaProcesado
     * @return Pedido
     */
    public function setFechaProcesado($fechaProcesado)
    {
        $this->fechaprocesado = $fechaProcesado;

        return $this;
    }

    /**
     * Get fecha_procesado
     *
     * @return string 
     */
    public function getFechaProcesado()
    {
        return $this->fechaprocesado->format('d-m-Y H:i');
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Pedido
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set isdevolucion
     *
     * @param boolean $isdevolucion
     * @return Pedido
     */
    public function setIsdevolucion($isdevolucion)
    {
        $this->isdevolucion = $isdevolucion;

        return $this;
    }

    /**
     * Get isdevolucion
     *
     * @return boolean 
     */
    public function getIsdevolucion()
    {
        return $this->isdevolucion;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Pedido
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }
}
