<?php
    
    $db = mysqli_connect('localhost', 'root', '', 'orders');

    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    function filterTable($query)
    {
       $connect = mysqli_connect("localhost", "root", "", "orders");
        $filter_Result = mysqli_query($connect, $query);
        return $filter_Result;

    }
    
    $query = "SELECT * FROM category";
    $search_result = filterTable($query);
    
    $queryP = "SELECT * FROM product";
    $search_P = filterTable($queryP);
    
    $queryQ = "SELECT * FROM quantity";
    $search_Q = filterTable($queryQ);
    
?>

<!DOCTYPE html>
<html>
	
	<head>
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
                
                
                <SCRIPT SRC="help.js" TYPE="text/JavaScript"> </SCRIPT>
                
                
		
		<title> The Orders </title>
		
	</head>
	
	<body>
		<div id="page_wrapper">
			
			<!-- START top header -->
			<div id="top_header" >
				<div id="top_logo">
					
				</div>
				<div id="company_name">The Orders</div>
				<div id="slogan">Orders</div>
			</div>
			<!-- END top header -->

			<!-- START top menu -->
			<nav id="top_menu_nav">
				<ul id="top_menu_list">
					<li class="active"> <a href="index.php"> Home </a> </li>
					<li> 
						<a href="#"> Category </a> 
						<ul class="top_menu_submenu">
                                                    <?php while($row = mysqli_fetch_array($search_result)){?>
                                                    <li> <a href="#"><?php echo $row['Name'];?></a> </li>
                                                    <?php }?> 
						</ul>
					</li>
					<li> 
						<a href="#"> Products </a> 
						<ul class="top_menu_submenu">
                                                    <?php while($row1 = mysqli_fetch_array($search_P)){?>
                                                    <li> <a href="#"><?php echo $row1['Name'];?></a> </li>
                                                    <?php }?> 
						</ul>
					</li>
                                        <li> 
						<a href="#"> Quantity </a> 
						<ul class="top_menu_submenu">
                                                    <?php while($row2 = mysqli_fetch_array($search_Q)){?>
                                                    <li> <a href="#"><?php echo $row2['Description'];?></a> </li>
                                                    <?php }?> 
						</ul>
					</li>
					<li> <a href="#"> Contact Us </a> </li>
				</ul>
			</nav>
			<!-- END top menu -->

			<!-- START breadcrumbs -->
			<ul id="breadcrumb">
				<li> <a href="#"> Home </a> </li>
				<li> <a href="#"> Home </a> </li>
				<li> Home </li>
			</ul>
			<!-- END breadcrumbs -->

			<!-- START page body -->
			<div id="page_body">


				<!-- START Featured products -->
				
				<!-- Page Body title -->
				<header class="content-title">
					<div class="title-bg">
						<h1 class="title">Make an order</h1>
					</div><!-- End .title-bg -->
					
				</header>
				<!-- END Page body title -->
                              
			<div id="featured_products">
                            
                            <table>
                                <tr>              
                                    <th>Product</th>
                                    <th>Add order</th>
                                </tr> 
                                
                                <tr>
                                    <td>
                                          <div id="app">

                                            <select style="background-color: greenyellow" v-model="selectedDrink">
                                                <option style="background-color: greenyellow" v-for="drink in drinks" :value="drink">{{ drink.label }}</option>
                                            </select>

                                            <select style="background-color: pink" v-model="selectedOption" v-if="selectedDrink != -1">
                                              <option style="background-color: pink" v-for="option in selectedDrink.options">{{ option }}</option>
                                            </select>
                                             

                                            <p v-if="selectedDrink&&selectedOption">
                                             <!-- You selected a {{ selectedDrink.label }} and specifically {{ selectedOption }}.-->
                                            </p>

                                        </div>
                                    </td>
                                    
                                    <td>
                                        <button type="submit">Add</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
	</body>
        

    <script>
        const app = new Vue({
        el:'#app',
        data:{
          drinks:[
            <?php 
            $query5 = "SELECT * FROM category";
            $search_result5 = filterTable($query5);
            while($row5 = mysqli_fetch_array($search_result5)){?>
            {
              label:"<?php echo $row5['Name'];?>",
              options:[
          <?php 
          $query6 = "SELECT * FROM product WHERE IdCategory={$row5['Id']}";
          $search_result6 = filterTable($query6);
          while($row6 = mysqli_fetch_array($search_result6)){?>
                                  "<?php echo $row6['Name'];?>",
                                  
                                    
          <?php }?>
                      ]
                    
            },<?php }?>
            
          ],

          selectedDrink:-1,
          selectedOption:'',
          options:[],
          selectedDrinkLabel:''
        },
        methods:{
          selectDrink:function() {
            this.selectedOption = '';
            this.options = this.drinks[this.selectedDrink].options;
            this.selectedDrinkLabel = this.drinks[this.selectedDrink].label;
          }
        }
      });
    </script>

</html>
