<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
          ['username'       => 'Admin',
           'first_name'     => 'Administrador',
           'last_name'      => 'Capo',
           'email'          => 'admin@admin.com',
           'password'       => bcrypt('aaaaaaaa'),
           'phone'          => '3310345345',
           'date_of_birth'  => '2000-12-25',
           'province_id'    => 1,
           'sex_id'         => 1,
           'role_id'        => 1, //admin
           'user_status_id' => 1,
          ],
          ['username'       => 'Usuario',
           'first_name'     => 'Usuario',
           'last_name'      => 'Normal',
           'email'          => 'usuario@usuario.com',
           'password'       => bcrypt('aaaaaaaa'),
           'phone'          => '10345354345',
           'date_of_birth'  => '2013-12-20',
           'province_id'    => 2,
           'sex_id'         => 2,
           'role_id'        => 2, //usuario normal
           'user_status_id' => 2,
          ],
          ['username'       => 'Invitado',
           'first_name'     => 'Invitado',
           'last_name'      => 'Ultimo',
           'email'          => 'invitado@invitado.com',
           'password'       => bcrypt('aaaaaaaa'),
           'phone'          => '103658745',
           'date_of_birth'  => '2125-12-18',
           'province_id'    => 3,
           'sex_id'         => 1,
           'role_id'        => 3, //invitado
           'user_status_id' => 3,
          ],
      ];

      foreach ($users as $user)
      {
          \App\User::create($user);
      }
    }
}
