<?php 
            $_SESSION['cryptocoin']['json_eth'] = file_get_contents('https://ethermine.org/api/miner_new/' . $row['user_eth_address'] . '');

            $_SESSION['cryptocoin']['json_ubq'] = file_get_contents('https://ubiqpool.io/api/accounts/' . $row['user_ubq_address'] . '');
set_time_limit(300); //Sætter max execusion tid til 120 sek.
$json = file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=1500');
        $obj = json_decode($json);
        foreach($obj as $key){
            $cn = $key->id;
            $cr = $key->rank;
            $c_p_u = $key->price_usd;
            $c_p_b = $key->price_btc;
            $c_m_u = $key->market_cap_usd;
            $p1h = $key->percent_change_1h;
            $p24h = $key->percent_change_24h;
            $p7d = $key->percent_change_7d;
            $lu = $key->last_updated;
                  $query = "UPDATE `coins2` SET
                  `coin_rank`='$cr',
                  `coin_price_usd`='$c_p_u',
                  `coin_price_btc`='$c_p_b',
                  `coin_marketcap_usd`='$c_m_u',
                  `percent_change_1h`='$p1h',
                  `percent_change_24h`='$p24h',
                  `percent_change_7d`='$p7d',
                  `last_updated`='$lu'
                  WHERE coin_name = '$cn'";
                   $result = mysqli_query($dbcon, $query) or die('SQL failed ' . mysqli_error($dbcon));


                }

      ?>