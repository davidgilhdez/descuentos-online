<?php

namespace ProductsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 */
class Producto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;
    private $descripcion_en;

    /**
     * @var float
     */
    private $precio;

    /**
     * @var int
     */
    private $cantidad;

    /**
     * @var bool
     */
    private $vendiendo;

    /**
     * @var int
     */
    private $descuento;

    /**
     * @var string
     */
    private $imagen;
    
    private $is_active;
    
    //creo variable para la relación
    protected $lineas;

	//constructor
	public function __construct(){
	$this->vendiendo = false;
	$this->is_active = true;
		
	}

	public function getPrecio_descuento(){
	return number_format(round($this->precio*((100 - $this->descuento)/100),2),2);	
	}
	
	public function getNombretoUrl(){
	return str_replace(' ','-',	$this->nombre);
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
    
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
    

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    

    /**
     * Set precio
     *
     * @param float $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Producto
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
     * Set vendiendo
     *
     * @param boolean $vendiendo
     * @return Producto
     */
    public function setVendiendo($vendiendo)
    {
        $this->vendiendo = $vendiendo;

        return $this;
    }

    /**
     * Get vendiendo
     *
     * @return boolean 
     */
    public function getVendiendo()
    {
        return $this->vendiendo;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return Producto
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return integer 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Producto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set descripcion_en
     *
     * @param string $descripcionEn
     * @return Producto
     */
    public function setDescripcionEn($descripcionEn)
    {
        $this->descripcion_en = $descripcionEn;

        return $this;
    }

    /**
     * Get descripcion_en
     *
     * @return string 
     */
    public function getDescripcionEn()
    {
        return $this->descripcion_en;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Producto
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }
}
