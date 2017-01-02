<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devolucion
 */
class Devolucion
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $fecha;

    /**
     * @var int
     */
    private $cantidad;
    
    private $importe;
    private $resolucion;
    
    protected $usuario;
    protected $producto;
    protected $linea_pedido;
    
    public function __construct(){
		$this->estado = "Sin tramitar"; 
		$this->resolucion = "-";
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
     * Set tipo
     *
     * @param string $tipo
     * @return Devolucion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Devolucion
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Devolucion
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
     * Set fecha
     *
     * @param string $fecha
     * @return Devolucion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha->format('d-m-Y H:i');
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Devolucion
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
     * Set usuario
     *
     * @param \UsersBundle\Entity\Usuario $usuario
     * @return Devolucion
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
     * Set producto
     *
     * @param \ProductsBundle\Entity\Producto $producto
     * @return Devolucion
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
     * Set importe
     *
     * @param float $importe
     * @return Devolucion
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
     * Set resolucion
     *
     * @param string $resolucion
     * @return Devolucion
     */
    public function setResolucion($resolucion)
    {
        $this->resolucion = $resolucion;

        return $this;
    }

    /**
     * Get resolucion
     *
     * @return string 
     */
    public function getResolucion()
    {
        return $this->resolucion;
    }

    /**
     * Set linea_pedido
     *
     * @param \UsersBundle\Entity\Linea_pedido $lineaPedido
     * @return Devolucion
     */
    public function setLineaPedido(\UsersBundle\Entity\Linea_pedido $lineaPedido = null)
    {
        $this->linea_pedido = $lineaPedido;

        return $this;
    }

    /**
     * Get linea_pedido
     *
     * @return \UsersBundle\Entity\Linea_pedido 
     */
    public function getLineaPedido()
    {
        return $this->linea_pedido;
    }
}
