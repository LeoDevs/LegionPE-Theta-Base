<?php

/**
 * Theta
 * Copyright (C) 2015 PEMapModder
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace legionpe\theta\shops;

use legionpe\theta\BasePlugin;
use legionpe\theta\config\Settings;
use legionpe\theta\query\RawAsyncQuery;

class KitEntry{
	/** @var Kit */
	private $kit;
	/** @var int */
	private $slot, $name, $value;
	/** @var Purchase|null */
	private $purchase;
	/** @var bool */
	private $inserted;
	/**
	 * @param Kit $kit
	 * @param int $slot
	 * @param string $name
	 * @param int $value
	 * @param Purchase|null $purchase
	 * @param bool $inserted
	 */
	public function __construct(Kit $kit, $slot, $name, $value, $purchase, $inserted = true){
		$this->kit = $kit;
		$this->slot = $slot;
		$this->name = $name;
		$this->value = $value;
		$this->purchase = $purchase;
		$this->inserted = $inserted;
	}
	/**
	 * @return Kit
	 */
	public function getKit(){
		return $this->kit;
	}
	/**
	 * @return int
	 */
	public function getSlot(){
		return $this->slot;
	}
	/**
	 * @return string
	 */
	public function getName(){
		return $this->name;
	}
	/**
	 * @return int
	 */
	public function getValue(){
		return $this->value;
	}
	/**
	 * @return Purchase|null
	 */
	public function getPurchase(){
		return $this->purchase;
	}
	/**
	 * @return boolean
	 */
	public function isInserted(){
		return $this->inserted;
	}
	public function insert(BasePlugin $main){
		$this->inserted = true;
		$class = Settings::$LOCALIZE_CLASS;
		new RawAsyncQuery($main, "INSERT INTO kits_slots (uid, class, kitid, slot, name, value) VALUES ({$this->kit->uid}, $class, {$this->kit->kitid}, $this->slot, $this->name, $this->value)");
	}
}
