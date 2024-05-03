<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $name = $_POST['title'];
    $sellerID = $session->getID();
    $categoryID = $_POST['category'];
    $sizeID = $_POST['sizes'];
    $conditionID = $_POST['condition'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $images = $_POST['foto'];

    //brand, size e model não são campos obrigatórios
    if (!empty($name) && !empty($categoryID) && !empty($conditionID)
    && !empty($description) && !empty($price) && !empty($images)) {
        echo "Formulário.";
        if ($name !== false && $sellerID !== false && $categoryID !== false && $sizeID !== false &&
            $conditionID !== false && $brand !== false && $model !== false &&
            $description !== false && $price !== false && $images !== false) {
            try {
                echo "Item added.";
                $itemID = Item::addItem($db, $name, $sellerID, $categoryID, $sizeID, $conditionID, $brand, $model, $description, $price, $images);
                $session->addMessage('success', 'O item foi adicionado com sucesso!');
                header('Location: /../pages/sellItem.php?id=' . $itemID);
                exit;
            } catch (Exception $e) {
                $session->addMessage('error', 'Erro ao adicionar o item: ' . $e->getMessage());
                header('Location: /../pages/sellItem.php');
                exit;
            }
        } else {
            $session->addMessage('error', 'Todos os campos do formulário devem ser preenchidos corretamente!');
            header('Location: /../pages/sellItem.php');
            exit;
        }
    }
    else{
       /* $session->addMessage('error', 'Todos os campos do formulário devem ser fornecidos!');
        header('Location: /../pages/sellItem.php');
        exit;*/
        echo "Por favor, preencha todos os campos obrigatórios do formulário.";
    }

    ?>