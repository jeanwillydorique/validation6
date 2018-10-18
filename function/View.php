<?php 
    
class View 
{

    public $head = "./views/layour/header.html" ;
    public $footer = "./views/layour/footer.html" ;
    public $errorPage = "./views/layour/_404.html" ;
    public $product = "./views/product/";
    public $imgErrorLink = "./image/page-404-personnalisee.jpg";
    public $CSSlink = '<link rel="stylesheet" type="text/css" href="./views/cssstyle/';
    public $menu = "./views/layour/menu.html" ;
    public $arrayDiffCompareProduct = [
        ".",
        "..",
        ".DS_Store",
    ];

        // this function show all or a select list of products 
    public function renderView($i,$triType,$t)

        // the condition to choose page color
    {   
        if ($t === 1){
            $CSSlink = $this->CSSlink;
            $CSSlink .= $t;
            $CSSlink .= '.css">';
        } elseif ($t === 2){
            $CSSlink = $this->CSSlink;
            $CSSlink .= $t;
            $CSSlink .= '.css">';
        } elseif ($t === 3){
            $CSSlink = $this->CSSlink;
            $CSSlink .= $t;
            $CSSlink .= '.css">';
        } elseif ($t === 4){
            $CSSlink = $this->CSSlink;
            $CSSlink .= $t;
            $CSSlink .= '.css">';
        }


         // the part is for range the product list and display the choose number of products
        $i = explode("/", $i);

        // scan the prodcut folder
        $productList = scandir($this->product);

        // the condition to range
        if ($triType == 1){
            rsort($productList);
        } elseif ($triType == 2) {
            asort($productList);
        }

        // for compare whitelist an product list
        $productsToDisplay = array_diff($productList,$this->arrayDiffCompareProduct);

        // count of product and condition to display the choose number of products
        $productNumber = count($productsToDisplay);
        // if the choose number < number of products
        if ($i[1] > 0 && $i[1] <= $productNumber){
            $newProductList = array_slice($productsToDisplay, 0, $i[1]); 
                    
            $card = "<main>";
            foreach ($newProductList as $key => $value) {
                $jerseyLink = $this->product;
                $jerseyLink .= $value;
                $jersey = file_get_contents($jerseyLink);
                $card .= $jersey;
            }
            $card .= "</main>";
        } // if i is empty or = 0  
        elseif ($i[1] === "") {
            $newProductList = array_slice($productsToDisplay, 0, $productNumber); 
                    
            $card = "<main>";
            foreach ($newProductList as $key => $value) {
                $jerseyLink = $this->product;
                $jerseyLink .= $value;
                $jersey = file_get_contents($jerseyLink);
                $card .= $jersey;
            }
            $card .= "</main>";
 
        } // if the choose > number of product display 404 error page 
        else { 
            $card = '<div class="contener">';
            $card .= "<H1>le nombre maximum de section est de $productNumber</H1>";
            $card .= "<br>";
            $card .= "<H1>C'est pas bien d'être gourmand !!!</H1>";
            $card .= "<br>";
            $card .= '<img src="';
            $card .= $this->imgErrorLink;
            $card .= '">';
            $card .= '</div>';

            $card .= file_get_contents($this->errorPage);

        }

        // final echo with all templates

        echo file_get_contents($this->head) 
        . $CSSlink 
        . file_get_contents($this->menu) 
        . $card 
        . file_get_contents($this->footer);
    
    }


}

?>