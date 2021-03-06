<?php
/*
 * Created on Fri Sep 03 2021
 *
 * Mart Developers Inc
 * https://martdev.info
 * martdevelopers254@gmail.com
 * +254 740 847 563 / +254 737 229 776
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 Devlan Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


/* Load Analytics */
$login_id = $_SESSION['login_id'];
$ret = "SELECT * FROM motorist m INNER JOIN login l ON m.motorist_login_id = l.login_id WHERE l.login_id = '$login_id' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($of = $res->fetch_object()) {


    /* Rules */
    $query = "SELECT COUNT(*)  FROM `traffic_rules` ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($rules);
    $stmt->fetch();
    $stmt->close();


    /* Offences */
    $query = "SELECT COUNT(*)  FROM `offences` WHERE offence_motorist_id = '$of->motorist_id' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($offences);
    $stmt->fetch();
    $stmt->close();


    /* Payments */
    $query =
        "SELECT SUM(payment_amount) FROM offenses_payments p 
        INNER JOIN  offences o ON p.payment_offence_id  = o.offence_id
        INNER JOIN motorist m ON o.offence_motorist_id = m.motorist_id
        WHERE m.motorist_id = '$of->motorist_id' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($offenses_payments);
    $stmt->fetch();
    $stmt->close();
}
