<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../classes/category.class.php');

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
    $images = $_POST['foto'];

    //brand, size e model não são campos obrigatórios
    if (!empty($name) && !empty($categoryName) && !empty($conditionName)
    && !empty($description) && !empty($price) && !empty($images)) {
        echo "Formulário.";
        if ($name !== false && $sellerID !== false && $categoryName !== false && $sizeName !== false &&
            $conditionName !== false && $brand !== false && $model !== false &&
            $description !== false && $price !== false && $images !== false) {
            try {
                /*echo "Item added.";
                echo $categoryName;*/
                $category = Category::getCategoryByName($db, $categoryName);
                /*echo "apos getCategory";*/
                $condition = Condition::getConditionByName($db, $conditionName);
                /*echo "apos getCondition";*/
                $size = Size::getSizeByName($db, $sizeName); 
                /*echo "apos getSize";
                echo "antes do add item";*/
                Item::addItem($db, $name, $sellerID, $category->categoryID, $size->sizeID, $condition->conditionID, $brand, $model, $description, $price, $images);
                $session->addMessage('success', 'O item foi adicionado com sucesso!');
                header('Location: /../pages/home.php');
                
                exit;
                echo "sucesso";
            } catch (Exception $e) {
                /*$session->addMessage('error', 'Erro ao adicionar o item: ' . $e->getMessage());
                header('Location: /../pages/sellItem.php');
                exit;*/
                echo "erro.";
            }
        } else {
            /*$session->addMessage('error', 'Todos os campos do formulário devem ser preenchidos corretamente!');
            header('Location: /../pages/sellItem.php');
            exit;*/
            echo "Por , preencha todos os campos obrigatórios do formulário.";
        }
    }
    else{
       /* $session->addMessage('error', 'Todos os campos do formulário devem ser fornecidos!');
        header('Location: /../pages/sellItem.php');
        exit;*/
        echo "Por favor, preencha todos os campos obrigatórios do formulário.";
    }

    ?>