<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            position: relative;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease;
        }
        li:hover {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            font-size: 25px;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        button:hover {
            background-color: #2980b9;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .category-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
        .category-links a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <?php if(session()->getFlashdata('msg')):?>
        <?= session()->getFlashdata('msg') ?>
    <?php endif;?><br><br>
<div class="container">


    <button onclick="window.location.href='/insert'">Add New</button>
<br><br><br>
    <ul>
        <?php foreach ($pr as $p ): ?>
        <li>
            <a href="/edit/<?=$p['id']?>"><?= $p['Name'] ?></a><br>
            <?= $p['Description'] ?><br>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
