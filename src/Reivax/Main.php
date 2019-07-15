<?php
namespace Reivax;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;

class Main extends PluginBase{
     public function onEnable(){
          $this->getLogger()->info("Heal Enabled");
     }
     public function onCommand(CommandSender $sender, Command $command, $labels, array $args){
          $cmd = strtolower($command);
          if($cmd == "heal"){
               if($sender->hasPermission("heal.reivax") && $sender instanceof Player) {
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage(Color::GREEN."You've been healed!");
               }
               if(isset($args[0])){
                    if($sender->hasPermission("heal.other")){
                      $player = $this->getServer()->getPlayer($args[0]);
                      if($player !== null){
                          $player->setHealth($sender->getMaxHealth());
                          $sender->sendMessage(Color::GREEN . "$args[0] has been healed");
                          $player->sendMessage(Color::GREEN . "You have been healed by ". $sender->getName());
                     }else{
                          $sender->sendMessage(Color::RED . "That player is not online");
                     }
                    }
               }
          }
     }
     public function onDisable(){
          $this->getLogger()->info("Heal Disabled");
     }
}
