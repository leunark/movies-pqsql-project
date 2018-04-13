<!DOCTYPE html>
<html>
<head>
	<!--Imports-->
	<?php include('import.php'); ?>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Title of the website-->
	<title>PQSQL PROJECT</title>
</head>

<body>
	<!--Navbar-->
	<?php include('navbar.php'); ?>

	<main>
		<div class="section"></div>
		
		<!--Container-->
		<div class="container">
			<form class="col s12">
				<div class="row">
					<div class="input-field col s8">
						<input id="inputSearch" placeholder="Search query" type="text" class="validate" data-length="100">
						<label for="inputSearch">Search Input</label>
					</div>
					<div class="input-field col s3">
						<select id="selectMode">
							<option value="" disabled selected>Choose your option</option>
							<option value="0">Front End Filter</option>
							<option value="1">Fuzzy Search</option>
							<option value="2">Metaphone Search</option>
							<option value="3">Movies of Actors</option>
							<option value="4">Actors of Movies</option>
						</select>
						<label>Mode Select</label>
					</div>
					<div class="input-field col s1">
						<button id="buttonSearch" class="btn waves-effect waves-light btn-small" style="background-color: #232d37;">
							<i class="material-icons">send</i>
						</button>
					</div>
				</div>

				<table id="tableData" class="highlight">
					<thead>
						<tr>
							<!-- TABLE HEADER -->
							<th>id</th>
							<th><a style="color:blue;">actor</a> / <a style="color:green;">title</a></th>
						</tr>
					</thead>
					<tbody>
						<!-- TABLE CONTENT -->
					</tbody>
				</table>
				
			</form>
		</div>

		<div class="section"></div>
		<div class="section"></div>
	</main>

	<!--Footer-->
	<?php include('footer.php') ?>
	<script type="text/javascript" src="../js/index.js"></script>
</body>
</html>