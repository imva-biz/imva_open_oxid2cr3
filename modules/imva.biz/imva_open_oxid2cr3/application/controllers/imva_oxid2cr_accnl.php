<?php

/**
 * IMVA Oxid2CR 3 (Open Source Edition)
 * 
 * 
 * Redistribution permitted.
 * 
 * Weitergabe verboten.
 * 
 *
 * This Software is intellectual property of imva.biz respectively of its author and is protected
 * by copyright law. This software product is open-source, but not freeware.
 *
 * Any unauthorized use of this software product - usage without a valid license,
 * modification, copying, redistribution, transmission is a violation of the license agreement
 * and will be prosecuted by civil and criminal law.
 * 
 * By applying and using this software product, you agree to the terms and condition of usage and
 * furthermore agree, not to share information, source codes, technologies, credentials and addresses
 * of any kind.
 * 
 *  
 * Mit der �bernahme dieser Software akzeptieren Sie die zwischen Ihnen und dem Herausgeber
 * festgehaltenen Bedingungen und wahren Stillschweigen �ber die Ihnen zug�nglich gemachten
 * Informationen, Quellcodes, Technologien, Zugangsdaten und Adressen jeglicher Art.
 * Der Bruch dieser Bedingungen kann Schadensersatzforderungen nach sich ziehen.
 * 
 * (c) 2012-2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 * 
 * 12/3/3-13/5/14
 * V 2.9.2.9
 * 
 */

class imva_oxid2cr_accnl extends imva_oxid2cr_accnl_parent
{
	
	
	
	/**
	 * Services and providers
	 */
	protected $_oSvc;
	protected static $_oConfig;
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->_oSvc = new imva_oxid2cr_service();
		$this->_oConfig = $this->getConfig();
	}
	
	
	
	/**
	 * render
	 * Called on page generation
	 * 
	 * @return template
	 */
	public function render()
	{
		$sReturn = parent::render();
		
		// form?
		if ($this->_getNLstate() == 0){;
			$this->_oSvc->disableSubscriber($this->_getUseraddr());
		}
		elseif ($this->_getNLstate() == 1){
			$this->_oSvc->enableSubscriber($this->_getUseraddr());
		}
		
		return $sReturn;
	}
	
	
	
	/**
	 * _getNLstate
	 * returns the value of the "status" field
	 * 
	 * @return string
	 */
	private function _getNLstate(){
		$theState = $this->_oConfig->getParameter('status');
		if ($theState != ''){
			return $theState;
		}
		else{
			return false;
		}
	}
	
	
	
	private function _getUseraddr(){
		$oUser = $this->getUser();
		return $oUser->oxuser__oxusername->value;
	}
}