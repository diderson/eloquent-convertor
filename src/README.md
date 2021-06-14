## Query Convertor

DB::table('users')
    ->where('id',23)
    ->get();

DB::table('users')
    ->where('id',like, '%23%')
    ->get();

DB::table('users')
    ->where('name','=', 'Payfast')
    ->where('account', 10000111)
    ->get();