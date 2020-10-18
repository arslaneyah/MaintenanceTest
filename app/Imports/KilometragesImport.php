<?php

namespace App\Imports;

use App\Kilometrage;
use App\Gasoil ;
use App\Vehicule ;
use App\Cuve ;
use App\Fournisseur ;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Auth ;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class KilometragesImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $user= Auth::user();
        $cuve = Cuve::where('unite_id', $user->unite->id )->first() ;
        try{
        foreach ($rows as $row=>$value)
        {
            if($row>0){
                $date= \PhpOffice\PhpSpreadsheet\Shared\Date::excelTodateTimeObject($value[2]);

                $vehicule = Vehicule::where('n_park',$value[3])->first();
                $cuve->quantite_gasoil=($cuve->quantite_gasoil)-($value[1]) ;
                $km= new Kilometrage();
                $km->dernier_km=$value[0] ;
                $km->date= $date;
                $km->user_id=$user->id;
                $km->vehicule_id= $vehicule->id;
                $km->save();;
                $gasoil= new Gasoil();
                $gasoil->kilometrage_id=$km->id ;
                $gasoil->litres = $value[1];
                $gasoil->fournisseur_id=Fournisseur::all()->first()->id;
                $gasoil->cuve_id=$cuve->id ;
                $gasoil->type=1 ;
                $gasoil-> save() ;


        }
        Alert::success('Operation Conclue', 'Succés');
    }


        }catch(Exception $e){

            Alert::error('erreur', 'Succés');

        }

        }

    }

