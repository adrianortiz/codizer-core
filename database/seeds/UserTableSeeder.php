<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncar la tabla de usuarios
        // DB::table('users')->truncate();

        /*
        factory(App\User::class)->create([
<<<<<<< HEAD
        'name' => 'Adrian',
            'email' => 'adrian@codizer.com',
=======
            'name' => 'Angel',
            'email' => 'angel@codizer.com',
>>>>>>> modulo-admin
            'role' => 'admin',
            'password' => bcrypt('secret')
        ]);
        */

        // Usurio Adrian
        $id = \DB::table('users')->insertGetId([
            'name' => 'Adrian',
            'email' => 'adrian@codizer.com',
            'role' => 'admin',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $idForm = \DB::table('forms')->insertGetId([
            'name' => 'Alumnos',
            'description' => 'Información de los alumnos de 8ITI1',
            'user_id' => $id,
            'remember_token' => str_random(10)
        ]);




        // GENERAR INPUTS DEL FORMULARIO Alumnos

        \DB::table('inputs')->insert([
            'title'             => 'Nombre Completo',
            'type_validation'   => 'val_text',
            'type_input'        => 'input_text',
            'description'       => 'Nombre completo del alumno',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Edad',
            'type_validation'   => 'val_num',
            'type_input'        => 'input_text',
            'description'       => 'Edad del alumno',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Sexo (Masculino, Femenino)',
            'type_validation'   => 'val_text',
            'type_input'        => 'input_text',
            'description'       => 'Sexo del Alumno (Masculino o Femenino)',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Peso (Kg)',
            'type_validation'   => 'val_double',
            'type_input'        => 'input_text',
            'description'       => 'Peso del Alumno (Eje: 1.73)',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Estatura (cm)',
            'type_validation'   => 'val_num',
            'type_input'        => 'input_text',
            'description'       => 'Estatura del Alumno (Eje: 173)',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Municipio',
            'type_validation'   => 'val_text',
            'type_input'        => 'input_text',
            'description'       => 'Municipio donde recide el Alumno',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Colonia',
            'type_validation'   => 'val_text_num',
            'type_input'        => 'input_text',
            'description'       => 'Colonia donde recide el Alumno',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Costo por Semana (pesos)',
            'type_validation'   => 'val_double',
            'type_input'        => 'input_text',
            'description'       => 'Gastos realizados por semana',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Tiempo Ida (minutos)',
            'type_validation'   => 'val_num',
            'type_input'        => 'input_text',
            'description'       => 'Minutos que tarda en ir a la Universidad',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Tiempo Regreso (minutos)',
            'type_validation'   => 'val_num',
            'type_input'        => 'input_text',
            'description'       => 'Minutos que tarda en volver de la Universidad',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('inputs')->insert([
            'title'             => 'Medio de transporte',
            'type_validation'   => 'val_text',
            'type_input'        => 'input_text',
            'description'       => 'Medio de transporte que usa con más frecuencia',
            'form_id'           => $idForm,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);





        /*

        // REGISTROS DE LA BD 1
        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Nombre',
            'content'   => 'Alan Rojar Herrera',
            'form_id'   => $idForm,
            'input_id'  => '1',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Sexo',
            'content'   => 'Masculino',
            'form_id'   => $idForm,
            'input_id'  => '3',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Municipio',
            'content'   => 'Ecatepec de Morelos',
            'form_id'   => $idForm,
            'input_id'  => '6',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Colonia',
            'content'   => 'Izcalli Jardines',
            'form_id'   => $idForm,
            'input_id'  => '7',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);


        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Medio de transporte',
            'content'   => 'Camion',
            'form_id'   => $idForm,
            'input_id'  => '11',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Edad',
            'content'   => '22',
            'form_id'   => $idForm,
            'input_id'  => '2',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Peso',
            'content'   => '80',
            'form_id'   => $idForm,
            'input_id'  => '4',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Estatura',
            'content'   => '186',
            'form_id'   => $idForm,
            'input_id'  => '5',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Costo Semana',
            'content'   => '300',
            'form_id'   => $idForm,
            'input_id'  => '8',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Ida (Min)',
            'content'   => '45',
            'form_id'   => $idForm,
            'input_id'  => '9',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);


        \DB::table('dvarchars')->insert([
            'dtitle'    => 'Regreso (Min)',
            'content'   => '40',
            'form_id'   => $idForm,
            'input_id'  => '10',
            'row_id'    => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        */















        // Usurio Alex
        $id = \DB::table('users')->insertGetId([
            'name' => 'Alex',
            'email' => 'alex@codizer.com',
            'role' => 'user',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        \DB::table('forms')->insert([
            'name' => 'Laboratorios',
            'description' => 'Información sobre calidad en las medidas de un laboratorio',
            'user_id' => $id,
            'remember_token' => str_random(10)
        ]);

        factory(App\User::class, 48)->create();

    }
}
