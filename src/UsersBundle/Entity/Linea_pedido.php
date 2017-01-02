<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Linea_pedido
 */
class Linea_pedido
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $cantidad;

    /**
     * @var float
     */
    private $importe;

	
	//creo variables para la relación
    protected $pedido;
    protected $producto;
    protected $usuario;
    protected $devoluciones;

	 public function __construct(){
	 //$this->pedido = $pedido;
	 $this->devoluciones = new ArrayCollection();
	 $this->cantidad = 0;
	 $this->importe = 0;
	 }
	 
	 public function getCantidadDevolver(){
	 	$total = 0;
	 	for($i=0;$i<sizeof($this->getDevoluciones());$i++){
	 	$total = $total + $this->getDevoluciones()[$i]->getCantidad();
	 	}
		$cantidad = $this->cantidad - $total;
		return $cantidad;
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Linea_pedido
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set importe
     *
     * @param float $importe
     * @return Linea_pedido
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
     * Set pedido
     *
     * @param \UsersBundle\Entity\Pedido $pedido
     * @return Linea_pedido
     */
    public function setPedido(\UsersBundle\Entity\Pedido $pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return \UsersBundle\Entity\Pedido 
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set producto
     *
     * @param \ProductsBundle\Entity\Producto $producto
     * @return Linea_pedido
     */
    public function setProducto(\ProductsBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \ProductsBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set usuario
     *
     * @param \UsersBundle\Entity\Usuario $usuario
     * @return Linea_pedido
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
     * Add devoluciones
     *
     * @param \UsersBundle\Entity\Devolucion $devoluciones
     * @return Linea_pedido
     */
    public function addDevolucione(\UsersBundle\Entity\Devolucion $devoluciones)
    {
        $this->devoluciones[] = $devoluciones;

        return $this;
    }

    /**
     * Remove devoluciones
     *
     * @param \UsersBundle\Entity\Devolucion $devoluciones
     */
    public function removeDevolucione(\UsersBundle\Entity\Devolucion $devoluciones)
    {
        $this->devoluciones->removeElement($devoluciones);
    }

    /**
     * Get devoluciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDevoluciones()
    {
        return $this->devoluciones;
    }
}
