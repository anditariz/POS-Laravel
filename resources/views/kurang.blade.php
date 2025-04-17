<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Form Kurang</h1>
    <form action="/actionKurang" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="number" name="angka1"><br>
        <label for="">angka2</label>
        <input type="number" name="angka2"><br>
        <button type="submit">Kurang</button>
    </form>
    <br>
    <h3>Totalnya : {{ $jumlah }}</h3>
</body>
</html>