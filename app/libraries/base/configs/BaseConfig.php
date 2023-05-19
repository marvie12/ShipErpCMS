<?php

class BaseConfig{
	public function __construct($properties = array()){
		$configClassName = get_class($this);

		foreach($properties as $property => $value){
			$propertySetterName = 'set'.ucfirst($property);

			if(property_exists($configClassName, $property) && method_exists($configClassName, $propertySetterName)){
				$propertyParameters = !is_array($value) ? (array) $value : $value;

				call_user_func_array(
					array(
						$this,
						$propertySetterName
					), 
					$propertyParameters
				);
			}
		}
	}
}