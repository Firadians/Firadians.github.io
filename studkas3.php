<?php

   class bank {
      protected  $name;
      
      public function acc_no(account_no $n) {
          echo $this->name . " has " . get_class($n);
      }
  }
    
  // Child 1
  class SBI extends bank {
      public function account() {
          echo $this->name . " has an SBI account ";
      }
        
      public function acc_no(account_detail $n) {
          echo $this->name . " has an SBI ". get_class($n);
      }
  }
    
  // Child2
  class BOI extends bank {
      public function account() {
          echo $this->name . " has a BOI account";
      }
  }
    
  interface acc_open {
      public function open($name): bank;
  }
      
  class SBI_acc_open implements acc_open {
        
      public function open($name): SBI {
          return new SBI($name);
      }
  }
      
  class BOI_acc_open implements acc_open {
        
      public function open( $name) : BOI {
          return new BOI($name);
      }
  }
     
  class account_detail{} 
  class account_no extends account_detail{}
     
  $k = (new BOI_acc_open)->open("Shreyank");
  $c = new account_no();
  $k->acc_no($c);
  echo("\n");
     
  $y = (new SBI_acc_open)->open("Shrey");
  $d = new account_detail();
  $y->acc_no($d);
  ?>
