<?php

namespace UsersBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 */
class Usuario implements UserInterface
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
    private $apellidos;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $ciudad;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $email;

    
    private $roles;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;
    
    
  	 private $is_active;
  	 private $salt;

	//variable para la relación con los pedidos
	protected $pedidos;
	protected $devoluciones;

	//constructor
	public function __construct($is_admin){
		if( $is_admin == false ){
    		$this->pedidos = new ArrayCollection;
    		$this->devoluciones = new ArrayCollection;   
    	}
    	$this->roles = 'ROLE_USER';
    	$this->is_active = true;
    	$this->salt = "";
    }

	
	
	//método para obtener pedidos
	public function getPedidos(){
	return $this->pedidos;	
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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Usuario
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Usuario
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

  

    /**
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add pedidos
     *
     * @param \UsersBundle\Entity\Pedido $pedidos
     * @return Usuario
     */
    public function addPedido(\UsersBundle\Entity\Pedido $pedidos)
    {
        $this->pedidos[] = $pedidos;

        return $this;
    }

    /**
     * Remove pedidos
     *
     * @param \UsersBundle\Entity\Pedido $pedidos
     */
    public function removePedido(\UsersBundle\Entity\Pedido $pedidos)
    {
        $this->pedidos->removeElement($pedidos);
    }
    
    //métodos de la interfaz
    
    public function getRoles(){
		return array($this->roles);
    }
    
    public function setRoles($rol){
    	$this->roles = $rol;
    }
    
    public function getSalt()
    {
        return $this->salt;
    }

    
    public function eraseCredentials(){}
    
    
    
    
    

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Usuario
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

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Add devoluciones
     *
     * @param \UsersBundle\Entity\Devolucion $devoluciones
     * @return Usuario
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
