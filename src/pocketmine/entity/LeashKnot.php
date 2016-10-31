<?php
/*
 *
 * ________              ________                         _________     
 *｜　　　 ｜ / ￣￣￣|  ｜　　　  ｜     /￣￣￣\          |   ___   |
 * ￣|　|￣  | /￣￣      ￣|　|￣      / /￣￣\  \        |  |___|  |
 *   |  |    \ \_____      |  |      /  /     \  \       |      ___| 
 *   |  |     \_____  \    |  |     /  /_______\  \      |  |\  \
 *   |  |           | |    |  |    /               \     |  | \  \
 *   |  |      _____/ |    |  |   /  /￣￣￣￣￣￣\  \    |  |  \  \
 *   |__|     |_______/    |__|  /  /             \  \   |__|   \__\
 *
 *
 *
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author DockCreaTer Team
 * @link http://www.github.com/DockCreaTer/
 * 
 *
*/
namespace pocketmine\entity;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\level\format\FullChunk;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\Network;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\Player;

class LeashKnot extends Entity{
	const NETWORK_ID = 88;
	//TO-DO: Find the REAL width, length and height.
	public $width = 0.98;
	public $length = 0.98;
	public $height = 0.98;
	protected $gravity = 0.04;
	protected $drag = 0.02;
	public $canCollide = false;
	private $dropItem = true;
	public function __construct(FullChunk $chunk, CompoundTag $nbt, bool $dropItem = true){
		parent::__construct($chunk, $nbt);
		$this->dropItem = $dropItem;
	}
	protected function initEntity(){
		parent::initEntity();
	}
	public function canCollideWith(Entity $entity){
		return false;
	}
	public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->type = LeashKnot::NETWORK_ID;
		$pk->eid = $this->getId();
		$pk->x = $this->x;
		$pk->y = $this->y;
		$pk->z = $this->z;
		$pk->speedX = $this->motionX;
		$pk->speedY = $this->motionY;
		$pk->speedZ = $this->motionZ;
		$pk->metadata = $this->dataProperties;
		$player->dataPacket($pk);
		parent::spawnTo($player);
	}
}
