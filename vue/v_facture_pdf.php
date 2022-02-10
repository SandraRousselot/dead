<?php
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
?>

<table>
<tr>
    <td>
        <img alt="" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD//gA+Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2NjIpLCBkZWZhdWx0IHF1YWxpdHkK/9sAQwAIBgYHBgUIBwcHCQkICgwUDQwLCwwZEhMPFB0aHx4dGhwcICQuJyAiLCMcHCg3KSwwMTQ0NB8nOT04MjwuMzQy/9sAQwEJCQkMCwwYDQ0YMiEcITIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIy/8AAEQgAeAEoAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A9/oopCQASTgDuaAFoqp/amn/APP/AGv/AH+X/Gk/tXT/APn/ALX/AL/L/jTswLlFRQ3MFypaCaOUDglGDY/KmSX1pC+yW6gRx1VpADSGk3sT0tVP7UsP+f62/wC/q/41PFPDcLuhlSRemUYEfpRcbjJbokpKWkoJFooooAKKSloAKKKKACiiigAooooAKKKKACiiigBKWiigAoorL1P+2ZJkg002sMTLl7mYF2U56Kgxn6k/hQNK7NOlrmtLOoW/imWxm1Sa+hS0EsxljRQjs2FC7QOoDcHPauloHKPKwooooJCiiigAooooAKKKKACq2of8g26/64v/ACNWar34LafchQSTEwAHfg01uB8f1NFZ3U8ZkitppIx1ZEJAq5/wjut4/wCQPqH/AIDP/hXWaAuuW1tDZf2Vf5dwS8Vk4mjwcBY3OAnGTn8TnpXtTmkro5kj2/wlaWFn4W06PTUC2xgVx6kkZJPvnOa80+Mlht1Cx1BYnAdDE7n7pI5H8zXqGi/bYdGj+125ilRflh8zzHwBxubux79fqa8b8Z6p4l8TtBb3WgXVsLV2IWOF2znHXj0H6187i2uVp9T6Xh6E/raqJpJb3dt0cHXu/wAIf+RNb/r6k/kteMf2FrH/AECr7/wHf/CvbPhTa3Fp4RaK5glhk+0udsiFTjC9jXLhU1PU+h4kqU5YK0Wnqv1O6ooor0T4IKKKKACikpaACiiigAooooAKKKKACiiigAooooAKKKKACmuQqFmOABkk06sLxXNJ/ZIsIHKz6hItohB5Ab7x/BQx/CgqMeZpHOaN4rtrX7RqVzYaiV1O8OydbfKlQMRqBnc3yrn5QRya6rSNcTVri6t/sd1ay2wQulwqgkNnB4J9OhwaztsMnidI1CpZaJa59lkcYH/fKA/991Y8JxtLp0uqSqRNqUzXRz1CHiMfggWkb1ORpyt/X/DG/RRSUzmFooooAKKKKACiiigAprMqIWYgKBkk9hTqq6l/yC7v/ri//oJoAp2PifQtSuBb2GsWFzMeRHDcozH8AaoeK/GFn4cs5AktnLqZCmKzmvI4CwJxuJY8LweeelfOnhe3a8tfBNiuj22lTTakZYtfZwGuAjnMfAznkAAnsMcGu/8AGtvcXPxySO28NWniFxoin7HdyIiAeYfnywIyOn40Aerp4k0q30mzvtQ1XTYEuV+WQXK+U7DqEY43AGrCa9pEmmvqMep2b2Mf37hZ1Ma/Vs4FeS/FC08iw8A20fh623fbRnR0ZBEWIUmLONuMkjOMVkan4U1fSfBHjzWLzSYdDtNQhhEGlQSrIse11y3y8D8PU0Ae7XOrafZWUd7dXtvDaybdk0kgVG3dME8HNQX3iPRNLuhbX+rWNrOQGEc9wqMQehwT7V5f8TWVvgloAUg73sQuO/yVlfELT7zVPjFcWthoNprM76DgQXThVj+cjzAT/EMjHQ80Ae23WqWFlbRXF1e28MErBI5JJAquT0AJ65qS8vbXTrR7q8uIre3T78srhVXtyTXz7c3UE/wH8Kwwzyyva61FBN5owUcM5K/QbgB7Yr074y/8ko1z/cj/APRi0AdhdapYWNh9uu7yCC02hvPkkCpg9Dk8VX0nxHouuhzpOqWl7s++LeZXK/UA8V5Pf2tv4h+I3g3QNc+fR00VLqG2c4SefBGD64ABx7e9WfHmi6V4Q8W+ENT8NWsGn6ncaitrJb2qhFnhbhsqOOOBn/a9hQB6zb6lZXc9xBbXUM01s22aOOQM0Z9GA6H61X/4SDR/sM99/adn9kgk8qWbz12Rvx8pOcA8jj3rg/hwQvxD+Ianhv7QjOD6YevPWwfgT43Ycq3iByD6jfFQB77p3iHRtXmaHTdVsryVF3MkE6uQOmSAeladcD8OdOlt0lnuvBOm+H38iNY7i1kjdrhTyd20Ajop59fau+oAKKKKACiiigAooooAKKKKACiiigArInsJ7jxNb3koX7La27CIZ5MrnDHHsox/wI1r0UDTa2OKu7S5g0M2E2F1LXb1ll2tnYjHLc/7MS4+tdlFGkUSRxqFRVCqB2ArnHureTxhdXN1PFDb6ZbrEpkcKA8nzMef9kKPxNa2maxaav5rWTPJFGQPO8shH/3WPDfUUGtTmaWnn9//AALGhRRRQYhRRRQAUUUUAFFFFABUc8SzwSQuSFkUqcehGKkqrqX/ACC7v/ri/wD6CaAOT/4Vn4ebwTB4UaS5azt5fOgm8wedG+4tuVgODyR06Gmax8M9M1vV4NVl1rWbe/htFtDPa3QiZ0Uk5YhepJ57e1eZfBvS9FvDo1zP4X1p9SWSSQax+8+yAqWI53bewXp1rkZntRPq62lpqaeJ5teeLTtQilMcCfvB8hYsBnr27jmgD6Jm8B6dcQaDHc3uoTtok/2i3lmmDPI2c/vGI5/Suhv7G11XTrixvI1mtbiMxyoejKRgivP/AIua/Nonw4Wye5jTUdTKWXmbtoGR+8bPYYzz71jfB3U7PTNe17wfaapFqNnCy3ljcJIHDoQA4yPQlf1oA3NN+D2g2OoWk0upatfWtlIJLWxurnfBCw6YXHb/ADmtLxF8NtK8S+IP7am1LVLS7+zi2Y2VyIgUBJweM859a8f8IavqHg/xJqfiiSR30C41ufTdQTk+TyGST8C5/IjvWrB4jvNA8HfEvU9Nl/fnXXjhmU5CB3C7h+B498UAekXvw38MXfha28KRSTWtrbzi5UQTgSlxn5iSCT1/lTYvhfpSaBqmkXGr6zd22oiMSNdXfmMmxtw2EjjJ6/QVi2XwW8OTaLbTtdah/bDqkzarFdP5pc4JI5xj8M+9Uvi9qNpPd+HPBl1qos7W5kE99dTShSsKAgZY92IP4gUAdv4g8BaJ4k0ixsrzz0ewVRa3cEmyaLAAyGx7DtiuFvfhprfhnxBZeKNA1FtfubZWWSHW5wWAPGUk4C/j09+lP8Ba/wD2l8G9e0yS5Se50e3ubUyI24PGEYxsD3GOB/u1iy6Nq+s/BLwe9jaTajaW0nnX+nxSlHuYw7cAjk9+Bzz7UAdvf/Dix8TzRa/Ne6hourXdui3w0u7ASQ7RlScENjpkdcVqSfDvw/J4GPhCLzodOYhmMcg8xmDBtxJBySR6V59ZP4YPwp8at4aOoWpEDG4028kbNm+37qqTwDg85J/LFW/g9pWiGWyvYPC+tWOoJYB21G68wQTkgBtmWwc5yOOlAHe+GPA9v4Xu5LiHWtavQ8XlCK+uzKijIOQMcHjFdTRRQAUUUUAFFFFABRRSEgdTQAtFN3DjnrRvTn5hx1oAdRVazv7a/thcW0u+JiQrFSucHBxkDI469D2qwCD0NAC0U3ev94Uu4etAFG40XTLu8W7uNPtZrhQAJZIlZhjpyRV5VCjA4HpRuHPI4oJA6mgbbe4tFJuGcZ5pA6knDA460CHUUm5fWk3DGc0AOopu9P7wpQwboc0ALRRRQAVFcw/aLWaDdt8xCmcdMjFS0nagDnvBPhYeDfClroa3Zuxblz5xj2btzFumT6+tc/H8KbJvC+uaJd3rTjU76S+jnEW1raRsbSvJzjHtkEjiunPiBIrvVhcRrFY6aq+bdGQn5ioYrtA7Aj8xVK18Y2o1G7s7+SKF7aFHbZvfLEKXUfKM48yMAdTu6UAZb/DmTUtW0G98QasurR6RbvEIJbQBZ3bjzHyx5xt4x1XNWrj4eWEfi/R/EOjmDSpLAOk0NvbKEuUYYwcEYPJ5we3pWk/jPRApMVxLOwaNdkMDsSX27RwO4dT+foavabq0WqXN6ls6vFbOIywJyWxk9RjHIwQTnmgDnNG+HVlp3h3XtEvbj7da6xeTXUmY9hTzAowOTyNuQf0qj4T+FNj4d8K6v4fvr1tTtNSfdJui8srwBxyeQQCD616HRQB4xpvgPxjPqV54dPizVrXwtY+WsErRKs0467EfOdq9N3T2xXZW3w5sG8W3+vavJHqxngjt4ILu3DiBEA7sTuY4znA7+tdpiloA4VfhtbWuua5fabdpZWmr6ebOaxitgEVtu0SLggcDPGOcnmoz8PtTtPB+i6No/im60+50okpcRwgpNknh4yeRye+PY131FAHndh8MJItD8SQahrb3mq+IE23V95AUKACBtQHtk9/yq94S8Ga/4amtY7nxhLqOm20Pkx2TWKRgADC/MGJ4rtqKAEpaKKACiiigAooooAK4fxXqNppfjrQLnUZDFYmyvI5GKMy5JiwDgHrzXcUmKAPIk0XVVt/E0enXdzcf2NbNDoSYIKCaMSEgn7zANsU9gPU1BrX/AAiDeCtRj8NRFb3yIPtO6Kbdt8+PPnereufmxntXrOp3q6bp8l20bOEK5VQSTlgOAOT16Vz7+K5HllktbRRbWpJuROWSRlLsg2KRnOVJwcdh1oA841OPTjpeiJCdFNqNSmMxitrgWw/ccb1J3k59DjpXp2m6vpWieDbK8mmgisFVU8y2hk8pcnGQDllXPc02PxNdfaYYZdOjXzXnXKTO+BFIEJ4j4yemcD3qW48SJFYvcJbeYVt7aYJvJz5zlQOFJ4x2B+lAHkSwo39gvqa2awvY3MinU4JnQ7rp2UgIQQSpBGe1dBrmq6rL4jXX9M06+m0vQDHEjwFRE6EZuSVLBm+VlC4B5Q12L+MzFeTW76e2YhGSwdhy3l/3kH/PX68cgZFS3Pi02nhyDVZbH5pnCrDvZeNpYklkBwACScYGM5xk0Aeca4NU07T/ABprNkLm5sdQnuLOeBckpuiXyZkHoGYqcdjntXXfELTbrVtD8OWVpJJFcPeIUkTPyOIJCrH2DBa6S/8AFFjY3mnwEhhervVi23ap+4cHn5mIA/H0qrd+Mbeya0aeBlt5oopZJd+RCsiuckY5wUA/4FntQB5uZvEWtX194jgtry2v9Q0W6jgt1yGiWN4Fwvo5Pmkd+RWjt0Jr7Tz4LimWRbecamY0dR5XktgTbusm/bjPzda66HxrNPbyyro8gaLYDEZDu3swXbnZszz3bPt3qV/GKLEbqO1iay2St5rT7WJQqu3aV6kuo5Iwc56UAef6TFq2kR+DNHmW5nsp3jvrac5JizayebC59ncFc9mI7VW0SLWNI0zwXYSJdT6ff31reRyNkm2k582NvRSSGGf9oV6QPGX7h7o2SNaLBHKWjn3P8xcFdu3GQY2HX0p8vi42l2kF5YqvyiSSSGfzEjjIJDE7R0I59Ac5IoA4P4d6bpOoFrPUYdLmnmSUSReRMLg4kz87E7SOAeB6V2fwy0e003wjbTw2ghurgN57EHc+12C5z7V1djcC80+2ugm0TxLJt64yAcfrVjFABRRRQAUhGQecUtIeAeM+1AHGz6Zo8UsmlTa3dSS3c5MsPnxBg0jBssAAcHbtGc8HAFaDeDbBwzNcXRkNy1wshZSyFnLso+XoSe+TwOeBjCv11GxXVNTuo7m1mu5HWM+bH5aHbsg6Z5B+bkhQWJzwKisbXxFdxWUkCXz2Ym8+Tz70o7MGkJT7zZT5YlHzFSpJ5zkAHQLpukXV3H5d9MZkv5bkhXwXlVdjAnHRVIHHoOa0dGsrTRrSPSLe4eUwIDiRgXC9ATgAdvTnB965E+HdektRbSRyeVMtuk6relVYl2kuHwP7xIX1wT1FdJ4c0++tvtdzqLTC4nkx5bz+YiqpO0qO3BA9TgZ5oA3qKTNFAC0UUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUANdFkQq6hl9CM1XfT7OSVJZLWB5I2LI7RglSeSQexq1RQBVk0+zlZGktYHaNiyFowSpJySPQk81D/YelAAf2bZ4C7cfZ16dcdOlaFFAFQabZqqqtpAFXoBEuB09v8AZX8h6U3+ytPFsLcWNt5AbeI/JXaG9cYxmrh6Vkw65EzSNMY44fPeNHaRV+VMKWOT03/Lx6igaTexZUacX+yr9mLhQnlALnC8gY9B+lOj0uwij2R2VsiY+6sSgd/b3P502LV9NmjEsV/bPGQSGWUYOBk09dTspJlhju4XkYjCq4JOQWH6AmgHF9g/syxE3nfY7fzf7/lLu65649aeLK2BBFvEMMXHyD7xOSfrkA/UVP2paBEAtLcMSIIsk5J2Dk5Jz+ZJ/E1HFptjAhSGzt40OSVSJQDkYPT1FW6KAGoixoqIoVVGAAMACnUUUAFFFFABSHpS0hAIwRxQBw91rmo+brOp20skunWkhSBRJGI3aMDcudpb5nOzj0OKLvx9JaPcQta2fn2sE0k6/a+jptCoPl5JZ1XPGCG6jBPZJZ20cZjS3iVCdxVUAGfXH4UNZWrli1tCSxyxKDnkH+YH5CgDkh4w1AKY47KzupInit3ZLrb5k7MoIVdpIXBc5P8AdPbmoJvHt1HJfQmwtC1tG/zLeEB5BIkSgZTgGQuuT/c6c12wtoAxYQxhi28naMlsYz9ccU37HbZJ+zxZJBPyDnByPyPP1oA4tPE15Mz6ZbGGVnuTawOLsLIUiKrKzMR97LcADPf3rul4FRLa26FCsEYKElSEHBPUj61NQAUUUUAFFFFABRRRQAlLRRQAlLRRQAUUUUAFFFFABRRRQAUlLRQA1wSjAHBI4Ncq/g5ri0hhub8looViBjjwMglt2CTySQT9K6yigqM5R2PONW8HrYLGkOoTs80gWKLYAqgvj65BkBH0Pat7TPBsOn30Vy93LOIizIjKB8xPUkdeD06V0zRo7KzIpZfukjkfSn0rGksRNq1xKWiimYhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAlLRRQAUUUUAFFFFAH//Z" />
    </td>
    <td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    </td>
    <td style="line-height:8px; text-align:right">
        <p  class="font-weight-bold mb-1"><b>Boutique des ventes</b></p>
        <p class="font-weight-bold mb-1">12 rue Louis Amstrong</p>
        <p class="font-weight-bold mb-1">87065 LIMOGES</p>
        <p class="font-weight-bold mb-1">Tél : 05 55 35 06 73</p>
        <p class="font-weight-bold mb-1">Mail : boutique.jean.monnet@gmail.com</p>
        <p class="font-weight-bold mb-1">N°SIRET : 19 870 999 0000 16</p>
    </td>
    </tr>
</table>

<hr>
<br />
<table>
<tr>
    <td style="line-height:10px">
    <p class="mb-1"><?= $lesResultatsFactures[0]->nom_client?>&nbsp;<?= $lesResultatsFactures[0]->prenom_client ?></p>
    <p><?= $lesResultatsFactures[0]->ville_client ?></p>
    </td>
    <td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td style="line-height:10px; text-align:right">
    <p >Facture N° <?= $lesResultatsFactures[0]->id_facture ?></p>
    <p >Date <?= $lesResultatsFactures[0]->date_facturation ?></p>
    </td>
    </tr>
</table>

<?php if($lesResultatsFactures[0]->reservation == 1){ 
    if($lesResultatsFactures[0]->id_moyen_reglement == 0){?> 
        <div style="padding:0% 10% 0% 10%; color:#084298; background-color:#cfe2ff; border-color:#b6d4fe; text-align:center; letter-spacing:7px; font-size:26px">
        <B >RÉSERVÉE</B>
    </div>
    <?php }else{ ?>
        <div style="padding:0% 10% 0% 10%; color:#084298; background-color:#cfe2ff; border-color:#b6d4fe; text-align:center; letter-spacing:7px; font-size:26px">
        <B >A ÉTÉ RÉSERVÉE</B>
        </div>
    <?php } 
} ?>
<?php if($lesResultatsFactures[0]->etat_annulation == 1){ ?>
    <div style="padding:0% 10% 0% 10%; color:red; background-color:#FFADAD; border-color:#b6d4fe; text-align:center; letter-spacing:7px; font-size:26px">
        <B >ANNULÉE</B>
    </div>
<?php } ?>
<br />
<table class="table">
    <thead style="border-bottom:1px solid black">
        <tr >
            <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Désignation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Portions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conso. avant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantité&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P. Unité&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
    </thead>
    
    <tbody>
    <?php foreach ($lesResultatsFactures as $key => $value) { ?> 
        <tr>
            <td style="text-align:center; line-height:26px; border-bottom:1px dashed lightgrey; letter-spacing:2px"><?= $value->denomination_produit; ?></td>
            <td style="text-align:center; line-height:26px; border-bottom:1px dashed lightgrey; letter-spacing:2px"><?= $value->nb_portions; ?></td>
            <td style="text-align:center; line-height:26px; border-bottom:1px dashed lightgrey; letter-spacing:2px"><?= $value->DLC; ?></td>
            <td style="text-align:center; line-height:26px; border-bottom:1px dashed lightgrey; letter-spacing:2px"><?= $value->quantite; ?></td>
            <td style="text-align:center; line-height:26px; border-bottom:1px dashed lightgrey; letter-spacing:2px"><?= $value->prix_unitaire; ?>€</td>
            <td style="text-align:center; line-height:26px; border-bottom:1px dashed lightgrey; letter-spacing:2px"><?= $value->prix_produit_total; ?>€</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<br />
<?php if($lesResultatsFactures[0]->id_moyen_reglement == 0){
    if($lesResultatsFactures[0]->etat_annulation == 0){
        $paiement = "Veuillez régler votre facture dans les meilleurs délais";
    }elseif($lesResultatsFactures[0]->etat_annulation == 1){
        $paiement = "Aucun paiement requis";
    }
}else if($lesResultatsFactures[0]->id_moyen_reglement != 0){
    if($lesResultatsFactures[0]->etat_annulation == 0){
        $paiement = "Réglé par ". $lesResultatsFactures[0]->nom_mode_reglement;
    }elseif($lesResultatsFactures[0]->etat_annulation == 1){
        $paiement = "Aucun paiement requis";
    }
} ?>

<div style="padding:1%; background-color:#EBEBEB; color:black">
    <table>
    <tr>
    <td width="440">
        <h3>&nbsp;&nbsp;<?= $paiement ?></h3>
    </td>
    <td style="width:70px; text-align:right">
        <p>Total</p>
        <?php if($lesResultatsFactures[0]->id_moyen_reglement == 0){
            if($lesResultatsFactures[0]->etat_annulation == 0){ ?>
                <h2><?= $lesResultatsFactures[0]->total_facture ?>€</h2>
            <?php }elseif($lesResultatsFactures[0]->etat_annulation == 1){ ?>
                <h2>0€</h2>
            <?php }
        } ?> 
    </td>
    </tr>
    </tbody>
    </table>
</div>

<?php


$html=ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Facture.pdf', Array('Attachment'=>0));
?>