<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/image.class.php');

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }


    $name = $_POST['title'];
    $sellerID = $session->getID();
    $categoryName = $_POST['category'];
    $sizeName = $_POST['sizes'];
    $conditionName = $_POST['condition'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    Image::addImage($db, "/../images/items/$name.jpg");

    $id = $db->lastInsertId();
    $originalFileName =  __DIR__ . "/../images/items/$name.jpg";
  
    move_uploaded_file($_FILES['foto']['tmp_name'], $originalFileName);
    $imageID = $id;

    //brand, size e model não são campos obrigatórios
    if (!empty($name) && !empty($categoryName) && !empty($conditionName)
    && !empty($description) && !empty($price) && !empty($imageID)) {
        echo "Formulário.";
        if ($name !== false && $sellerID !== false && $categoryName !== false && $sizeName !== false &&
            $conditionName !== false && $brand !== false && $model !== false &&
            $description !== false && $price !== false && $images !== false) {
            try {
                $category = Category::getCategoryByName($db, $categoryName);
                $condition = Condition::getConditionByName($db, $conditionName);
                $size = Size::getSizeByName($db, $sizeName); 
                Item::addItem($db, $name, $sellerID, $category->categoryID, $size->sizeID, $condition->conditionID, $brand, $model, $description, $price, $imageID);
                $session->addMessage('success', 'O item foi adicionado com sucesso!');
                header('Location: /../pages/profile.php');
                exit;
                echo "sucesso";
            } catch (Exception $e) {
                echo "erro.";
            }
        } else {
            echo "Por , preencha todos os campos obrigatórios do formulário.";
        }
    }
    else{
        echo "Por favor, preencha todos os campos obrigatórios do formulário.";
    }

    ?>