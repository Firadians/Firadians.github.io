<?php
#inheritance 
abstract class Animal{
    public string $name;

    abstract public function run():void;

        #tambahan untuk contravariance
    abstract public function eat(AnimalFood $animalFood): void;
}

class Cat extends Animal{
    public function run(): void{
        echo "$this->name si kucing sedang berlari" . PHP_EOL;
    }

        #tambahan untuk contravariance
        #tipe parameter yang digunakan dalam fungsi eat adalah kelas child
    public function eat(AnimalFood $animalFood):void{
        echo "$this->name si kucing sedang makan" . PHP_EOL;
        }
}

class Dog extends Animal{
    public function run(): void{
        echo "$this->name si anjing sedang berlari" . PHP_EOL;
    }

        #tambahan untuk contravariance
        #tipe parameter yang digunakan dalam fungsi eat adalah kelas parent
    public function eat(Food $animalFood): void{
        echo "$this->name si anjing sedang makan" . PHP_EOL;
    }
}

#COVARIANCE DIMULAI DISINI

interface AnimalShelter{
    function adopt(string $name): Animal;
}

class CatShelter implements AnimalShelter{
    public function adopt(string $name): Cat
    {
        $cat = new Cat();
        $cat->name = $name;
        return $cat;
    }
}

class DogShelter implements AnimalShelter{
    public function adopt(string $name): Dog
    {
        $dog = new Dog();
        $dog->name = $name;
        return $dog;
    }
}

#CLASS UNTUK CONTRAVARIANCE
class Food{

}

class AnimalFood extends Food{

}


#TEST COVARIANCE
class proses{
    public function menu2(){
    echo "selamat datang di penampungan hewan, Silahkan Pilih Hewan yang ingin diadopsi :". PHP_EOL;
    echo "1. Anjing" . PHP_EOL;
    echo "2. Kucing" . PHP_EOL;
    $pilih_hewan = (int)readline('Masukkan nomor hewan : ');
    if($pilih_hewan == 1){
        $dogShelter = new DogShelter();
        $nama_hewan = readline('Masukkan nama hewan : ');
        $dog = $dogShelter->adopt($nama_hewan);
        print($dog->run());
    }
    elseif($pilih_hewan == 2){
        $catShelter = new CatShelter();
        $nama_hewan = readline('Masukkan nama hewan : ');
        $cat = $catShelter->adopt($nama_hewan);
        print($cat->run());
    }
    else{
       echo "Pilihan tidak tersedia, silahkan coba lagi\n".PHP_EOL;
       $menu = new proses();
       $menu->menu2();
    }
    }

    #TEST CONTRAVARIANCE
    public function menu3(){
        echo "selamat datang di penampungan hewan, Silahkan Pilih Hewan yang ingin diadopsi :". PHP_EOL;
        echo "1. Anjing" . PHP_EOL;
        echo "2. Kucing" . PHP_EOL;
        $pilih_hewan = (int)readline('Masukkan nomor hewan : ');
        if($pilih_hewan == 1){
            $dogShelter = new DogShelter();
            $nama_hewan = readline('Masukkan nama hewan : ');
            $dog = $dogShelter->adopt($nama_hewan);
            $dog->eat(new Food());
        }
        elseif($pilih_hewan == 2){
            $catShelter = new CatShelter();
            $nama_hewan = readline('Masukkan nama hewan : ');
            $cat = $catShelter->adopt($nama_hewan);
            $cat->eat(new AnimalFood());
        }
        else{
           echo "Pilihan tidak tersedia, silahkan coba lagi\n".PHP_EOL;
           $menu = new proses();
           $menu->menu3();
        }
        }
}

$menu = new proses();
$menu->menu3();
