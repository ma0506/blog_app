<?php

// Class Dbc
// {
    function dbConnect() {
        $dsn = 'mysql:host=localhost;dbname=blog_app;charset=utf8';
        $user = 'blog_user';
        $pass = '0506';

        try {
            $dbh = new \PDO($dsn,$user,$pass,[
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]);
                // echo '接続成功';
                //sql準備
            } catch(PDOException $e) {
                echo '失敗'. $e->getMessage();
                exit();
            }
            return $dbh;
        }
    function getAllBlog() {
        $dbh = dbConnect();
        $sql = 'select * from blog';
        //sql実行
        $stmt = $dbh->query($sql);
        //sqlの結果を受け取る
        $result = $stmt->fetchall(\PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
    }

    function setCategoryName($category) {
        if ($category === '1') {
            return 'プログラミング';
        } elseif ($category === '2') {
            return '日常';
        } else {
            return 'その他';
        }
    }

    function getBlog($id) {
        if(empty($id)) {
            exit('IDが不正です');
        }
        
        $dbh = dbConnect();
        
        //sql準備
        $stmt = $dbh->prepare('select * from blog where id = :id');
        $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
        //sql実行
        $stmt->execute();
        //結果取得
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        // var_dump($result);
        
        if(!$result) {
            exit('ブログがありません');
        }
        return $result;
    }
    // function BlogCreate($blogs) {
    //     $sql = 'insert into
    //         blog(title,content,category,publish_status)
    //     values
    //         (:title, :content, :category, :publish_status)';

    //     $dbh = dbConnect();
    //     $dbh->beginTransaction();

    //     try {
    //         $stmt = $dbh->prepare($sql);
    //         $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
    //         $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
    //         $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_INT);
    //         $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_INT);
    //         $stmt->execute();
            
    //         echo 'ブログを投稿しました!';
    //     } catch(PDOException $e) {
    //             $dbh->rollBack();
    //             exit($e);
    //         }
    //         // return $dbh;
    // }
// }
?>
