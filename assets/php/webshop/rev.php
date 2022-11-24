<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); $uid = isset($id) ? $id : 0; $pid = $_POST['pid']; $model = $_POST['model']; 
$pr_sql = "SELECT reviews.pid, products__variations.color, products__variations.material, products__variations.style, products__variations.brand, products__variations.model, products__variations.custom, products__review.privacy AS 'priv_ena', reviews.id, reviews.uid, reviews.description, reviews.stars, reviews.date, reviews.privacy FROM `reviews` INNER JOIN products__review ON products__review.pid = reviews.pid INNER JOIN products__variations ON products__variations.pid = reviews.pid WHERE products__variations.model LIKE '$model' ORDER BY reviews.uid = $uid DESC, reviews.date DESC";
$pr_res = $con-> query($pr_sql); $rev__arr = array();
while ($rev = $pr_res-> fetch_assoc()) { $uid = $rev['uid']; $pid = $rev['pid']; $rid = $rev['id']; $object = new stdClass();
    if ($pr_res-> num_rows > 0) { $review = new stdClass();$variations = new stdClass();$initials = new stdClass();$user = new stdClass();
        $hdr__sql = "SELECT initials, color FROM customers__header WHERE uid = $uid"; $hdr__res = $con-> query($hdr__sql);$init = $hdr__res-> fetch_assoc();
        $ord__sql = "SELECT pid FROM orders WHERE pid = $pid AND uid = $uid"; $ord__res = $con-> query($ord__sql);if ($ord__res-> num_rows > 0) { $user->auth = true; } else { $user->auth = false; }
        $rvu__sql = "SELECT COUNT(id) AS amount FROM rv__u WHERE rid = $rid GROUP BY rid"; $rvu__res = $con-> query($rvu__sql); $rvu = $rvu__res-> fetch_assoc();
        if ($rev['priv_ena']) { $review->priv_ena = true; } else { $review->priv_ena = false; }
        
        if (isset($_SESSION['loggedin'])) {
            if ($rev['uid'] == $id) { $author = true; $user->author = true; $user->fullname = $una['fullname'];
                $usr__sql = "SELECT fullname FROM customers WHERE id = $uid"; $usr__res = $con-> query($usr__sql);$una = $usr__res-> fetch_assoc(); $user->fullname = $una['fullname'];
                $initials->initials = $init['initials'];$initials->color = $init['color'];
                if ($rev['privacy']) { $user->private = true; }
            } else { $user->author = false; $flg__sql = "SELECT id FROM rv__u WHERE uid = $id"; $flg__res = $con-> query($flg__sql);
                $flg__sql = "SELECT id FROM rv__u WHERE uid = $id AND rid = $rid"; $flg__res = $con-> query($flg__sql); if ($flg__res-> num_rows > 0) { $review->flagged = true; }
                $rpt__sql = "SELECT id FROM rv__r WHERE uid = $id AND rid = $rid"; $rpt__res = $con-> query($rpt__sql); if ($rpt__res-> num_rows > 0) { $review->reported = true; }
                if (!$rev['privacy']) { $user->private = false; $initials->initials = $init['initials'];$initials->color = $init['color'];
                    $usr__sql = "SELECT fullname FROM customers WHERE id = $uid"; $usr__res = $con-> query($usr__sql);$una = $usr__res-> fetch_assoc(); $user->fullname = $una['fullname'];
                } else { $user->private = true; }
            }
        } else { $user->author = false;
            if (!$rev['privacy']) { $user->private = false; $initials->initials = $init['initials'];$initials->color = $init['color'];
                $usr__sql = "SELECT fullname FROM customers WHERE id = $uid"; $usr__res = $con-> query($usr__sql);$una = $usr__res-> fetch_assoc(); $user->fullname = $una['fullname'];
            } else { $user->private = true; }
        }
        
        $review->id = $rev['id'];$review->description = $rev['description'];$review->stars = $rev['stars'];$review->date = $rev['date'];$review->helpful = $rvu['amount'];
        $variations->color = $rev['color'];$variations->style = $rev['style'];$variations->brand = $rev['brand'];$variations->model = $rev['model'];
        
        $object->variations = $variations;$object->review = $review;$object->initials = $initials;$object->user = $user; array_push($rev__arr, $object);
    }
} die(json_encode($rev__arr));
?>