<?php
	/*
	Parameters for the generate json program. This is similar to a header file.

	Note: $path_to_files must be an existing and read/write access
	granted directory to read/write files with this software.
	For example on linux, run
	$ chmod -R 777 <directory>
	where <directory> is the $path_to_files folder

	Author: Nate Sutton 
	Date:   2020
	*/

	include ("../db_access/permission_check.php"); // must be logged in

	$path_to_files = "/var/www/html/synaptome/php/synap_model/gen_json/";
	$csv_output = '';
	$write_csv_output = array();
	$parcel_csv_output = array();

	$num_conds = 32;
	$params = ["g","tau_d","tau_r","tau_f","u"];

	/*
	Read from input files

	Note: these are pre-existing files, not ones generated by this page.
	*/
	$json_template_file = $path_to_files."neuron_groups.json";
	$neuron_groups = file($json_template_file);

	$json_template_file = $path_to_files."neuron_groups_ordered.json";
	$neuron_groups_ordered = file($json_template_file);

	$json_template_file = $path_to_files."neuron_classes.json";
	$neuron_classes = file($json_template_file);

	$json_template_file = $path_to_files."neuron_classes_ordered.json";
	$neuron_classes_ordered = file($json_template_file);

	$json_template_file = $path_to_files."json_new_line.json";
	$json_new_line = file($json_template_file);
	$json_new_line = $json_new_line[0];

	$page = '';
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}

	$neuron_group = array();
	$parcels_skip = array(8,9,20,21,22,23,40,41,48,49,62,63);
	$write_output = array();
	$parcel_region = array();
	$parcel_layers = array();
	$parcel_output = array();
	$parcel_a_d = array();
	$vert_parcel_group = array("DG", "CA3", "CA2", "CA1", "Sub", "EC");
	$all_parcel_dend = array("DG:All:D", "CA3:All:D", "CA2:All:D", "CA1:All:D", "Sub:All:D", "EC:All:D");
	$all_parcel_axon = array("DG:All:A", "CA3:All:A", "CA2:All:A", "CA1:All:A", "Sub:All:A", "EC:All:A");
	$all_parcel_search = array();

	/* Important note: in $parcel_group the order of D 1st A 2cnd was swapped
	manually here compared to original data to accomidate preferences stated for the
	site. The new order is A 1st D 2cnd.*/
	$parcel_group = array("DG:SMo:A", "DG:SMo:D", "DG:SMi:A", "DG:SMi:D", "DG:SG:A", "DG:SG:D", "DG:H:A", "DG:H:D", "DG:All:A", "DG:All:D", "CA3:SP:A", "CA3:SP:D", "CA3:SL:A", "CA3:SL:D", "CA3:SR:A", "CA3:SR:D", "CA3:SLM:A", "CA3:SLM:D", "CA3:SO:A", "CA3:SO:D", "CA3:All:A", "CA3:All:D", "CA2:All:A", "CA2:All:D", "CA2:SO:A", "CA2:SO:D", "CA2:SP:A", "CA2:SP:D", "CA2:SR:A", "CA2:SR:D", "CA2:SLM:A", "CA2:SLM:D", "CA1:SLM:A", "CA1:SLM:D", "CA1:SR:A", "CA1:SR:D", "CA1:SP:A", "CA1:SP:D", "CA1:SO:A", "CA1:SO:D", "CA1:All:A", "CA1:All:D", "Sub:SM:A", "Sub:SM:D", "Sub:SP:A", "Sub:SP:D", "Sub:PL:A", "Sub:PL:D", "Sub:All:A", "Sub:All:D", "EC:I:A", "EC:I:D", "EC:II:A", "EC:II:D", "EC:III:A", "EC:III:D", "EC:IV:A", "EC:IV:D", "EC:V:A", "EC:V:D", "EC:VI:A", "EC:VI:D", "EC:All:A", "EC:All:D");
	/* Maunally sorted neuron group
	Note: the auto sorted one no longer used due to
	needing the same ordering as on the morphology page */
	$neuron_group = array("Granule", "Hilar Ectopic Granule", "Semilunar Granule", "Mossy", "Mossy MOLDEN", "AIPRIM", "DG Axo-Axonic", "DG Basket", "DG BC CCK+", "HICAP", "HIPP", "HIPROM", "MOCAP", "MOLAX", "MOPP", "DG Neurogliaform", "Outer Molecular Layer", "Total Molecular Layer", "CA3 Pyramidal", "CA3c Pyramidal", "CA3 Giant", "CA3 Granule", "CA3 Axo-Axonic", "CA3 Horizontal AA", "CA3 Basket", "CA3 BC CCK+", "CA3 Bistratified", "CA3 IS Oriens", "CA3 IS Quad", "CA3 Ivy", "CA3 LMR-Targeting", "Lucidum LAX", "Lucidum ORAX", "Lucidum-Radiatum", "Spiny Lucidum", "Mossy Fiber-Associated", "MFA ORDEN", "CA3 O-LM", "CA3 QuadD-LM", "CA3 Radiatum", "CA3 R-LM", "CA3 SO-SO", "CA3 Trilaminar", "CA2 Pyramidal", "CA2 Basket", "CA2 Wide-Arbor BC", "CA2 Bistratified", "CA2 SP-SR", "CA1 Pyramidal", "Cajal-Retzius", "CA1 Radiatum Giant", "CA1 Axo-axonic", "CA1 Horizontal AA", "CA1 Back-Projection", "CA1 Basket", "CA1 BC CCK+", "CA1 Horizontal BC", "CA1 Bistratified", "CA1 IS LMO-O", "CA1 IS LM-R", "CA1 IS LMR-R", "CA1 IS O-R", "CA1 IS O-Target QuadD", "CA1 IS R-O", "CA1 IS RO-O", "CA1 Ivy", "CA1 LMR", "CA1 LMR Projecting", "CA1 Neurogliaform", "CA1 NGF Projecting", "CA1 O-LM", "CA1 Recurrent O-LM", "CA1 O-LMR", "CA1 Oriens/Alveus", "CA1 Oriens-Bistratified", "CA1 O-Bistrat Projecting", "CA1 OR-LM", "CA1 Perforant Path-Assoc", "CA1 PPA QuadD", "CA1 Quadrilaminar", "CA1 Radiatum", "CA1 R-Recv Apical-Target", "Schaffer Collateral-Assoc", "SCR R-Targeting", "CA1 SO-SO", "CA1 Hipp-SUB Proj ENK+", "CA1 Trilaminar", "CA1 Radial Trilaminar", "SUB EC-Proj Pyramidal", "SUB CA1-Proj Pyramidal", "SUB Axo-axonic", "LI-II Multipolar-Pyramidal", "LI-II Pyramidal-Fan", "MEC LII-III PC-Multiform", "MEC LII Oblique Pyramidal", "MEC LII Stellate", "LII-III Pyramidal-Tripolar", "LEC LIII Multipolar Principal", "MEC LIII Multipolar Principal", "LIII Pyramidal", "LEC LIII Complex Pyramidal", "MEC LIII Complex Pyramidal", "MEC LIII BP Cmplx PC", "LIII Pyramidal-Stellate", "LIII Stellate", "LIII-V Bipolar Pyramidal", "LIV-V Pyramidal-Horiz", "LIV-VI Deep Multipolar", "MEC LV Multipolar-PC", "LV Deep Pyramidal", "MEC LV Pyramidal", "MEC LV Superficial PC", "MEC LV-VI PC-Polymorph", "LEC LVI Multipolar-PC", "LII Axo-Axonic", "MEC LII Basket", "LII Basket Multipolar Interneuron", "LEC LIII Multipolar Interneuron", "MEC LIII Multipolar Interneuron", "MEC LIII Superficial MPI", "LIII Pyramidal-Looking Interneuron", "MEC LIII Superficial Trilayered Interneuron");
	$neuron_group_hnc = array("Granule","Hilar Ectopic Granule","Semilunar Granule","Mossy","Mossy MOLDEN","AIPRIM","DG Axo-axonic","DG Basket","DG Basket CCK+","HICAP","HIPP","HIPROM","MOCAP","MOLAX","MOPP","DG Neurogliaform","Outer Molecular Layer","Total Molecular Layer","CA3 Pyramidal","CA3c Pyramidal","CA3 Giant","CA3 Granule","CA3 Axo-axonic","CA3 Horizontal Axo-axonic","CA3 Basket","CA3 Basket CCK+","CA3 Bistratified","CA3 Interneuron Specific Oriens","CA3 Interneuron Specific Quad","CA3 Ivy","CA3 LMR-Targeting","Lucidum LAX","Lucidum ORAX","Lucidum-Radiatum","Spiny Lucidum","Mossy Fiber-Associated","Mossy Fiber-Associated ORDEN","CA3 O-LM","CA3 QuadD-LM","CA3 Radiatum","CA3 R-LM","CA3 SO-SO","CA3 Trilaminar","CA2 Pyramidal","CA2 Basket","CA2 Wide-Arbor BC","CA2 Bistratified","CA2 SP-SR","CA1 Pyramidal","Cajal-Retzius","CA1 Radiatum Giant","CA1 Axo-axonic","CA1 Horizontal Axo-axonic","CA1 Back-Projection","CA1 Basket","CA1 Basket CCK+","CA1 Horizontal Basket","CA1 Bistratified","CA1 Interneuron Specific LMO-O","CA1 Interneuron Specific LM-R","CA1 Interneuron Specific LMR-R","CA1 Interneuron Specific O-R","CA1 Interneuron Specific O-Target QuadD","CA1 Interneuron Specific R-O","CA1 Interneuron Specific RO-O","CA1 Ivy","CA1 LMR","CA1 LMR Projecting","CA1 Neurogliaform","CA1 Neurogliaform Projecting","CA1 O-LM","CA1 Recurrent O-LM","CA1 O-LMR","CA1 Oriens/Alveus","CA1 Oriens-Bistratified","CA1 Oriens-Bistratified Projecting","CA1 OR-LM","CA1 Perforant Path-Associated","CA1 Perforant Path Associated QuadD","CA1 Quadrilaminar","CA1 Radiatum","CA1 R-Receiving Apical-Targeting","Schaffer Collateral-Associated","Schaffer Collateral-Receiving R-Targeting","CA1 SO-SO","CA1 Hippocampo-subicular Projecting ENK+","CA1 Trilaminar","CA1 Radial Trilaminar","SUB EC-Proj Pyramidal","SUB CA1-Proj Pyramidal","SUB Axo-axonic","LI-II Multipolar-Pyramidal","LI-II Pyramidal-Fan","MEC LII-III Pyramidal-Multiform","MEC LII Oblique Pyramidal","MEC LII Stellate","LII-III Pyramidal-Tripolar","LEC LIII Multipolar Principal","MEC LIII Superficial Multipolar Principal","LIII Pyramidal","LEC LIII Complex Pyramidal","MEC LIII Complex Pyramidal","MEC LIII Bipolar  Complex Pyramidal","LIII Pyramidal-Stellate","LIII Stellate","LIII-V Bipolar Pyramidal","LIV-V Pyramidal-Horizontal","LIV-VI Deep Multipolar Principal","MEC LV Multipolar-Principal","LV Deep Pyramidal","MEC LV Pyramidal","MEC LV Superficial Pyramidal","MEC LV-VI Pyramidal-Polymorphic","LEC LVI Multipolar-Pyramidal","LII Axo-axonic","MEC LII Basket","LII Basket Multipolar Interneuron","LEC LIII Multipolar Interneuron","MEC LIII Multipolar Interneuron","MEC LIII Superficial Multipolar Interneuron","LIII Pyramidal-Looking Interneuron","MEC LIII Superficial Trilayered Interneuron");

	$neuron_group_long = array("DG Granule (+)2201p", "DG Hilar Ectopic Granule (+)2203p", "DG Semilunar Granule (+)2311p", "DG Mossy (+)0103", "DG Mossy MOLDEN (+)2323", "DG AIPRIM (-)2333", "DG Axo-Axonic (-)2233", "DG Basket (-)2232", "DG Basket CCK+ (-)2232", "DG HICAP (-)2322", "DG HIPP (-)1002", "DG HIPROM (-)1333p", "DG MOCAP (-)0331", "DG MOLAX (-)3302", "DG MOPP (-)3000", "DG Neurogliaform (-)3000p", "DG Outer Molecular Layer (-)3222", "DG Total Molecular Layer (-)3303", "CA3 Pyramidal (+)23223p", "CA3c Pyramidal (+)03223p", "CA3 Giant (+)22010", "CA3 Granule (+)22100", "CA3 Axo-Axonic (-)22232", "CA3 Horizontal Axo-Axonic (-)00012", "CA3 Basket (-)22232", "CA3 Basket CCK+ (-)22232", "CA3 Bistratified (-)03333", "CA3 Interneuron Specific Oriens (-)01113", "CA3 Interneuron Specific Quad (-)03333p", "CA3 Ivy (-)03333", "CA3 LMR-Targeting (-)33200", "CA3 Lucidum LAX (-)02310", "CA3 Lucidum ORAX (-)03311", "CA3 Lucidum-Radiatum (-)03300", "CA3 Spiny Lucidum Dentate-Projecting (-)01320p", "CA3 Mossy Fiber-Associated (-)03330p", "CA3 Mossy Fiber-Associated ORDEN (-)02332p", "CA3 O-LM (-)11003", "CA3 QuadD-LM (-)12222", "CA3 Radiatum (-)03000", "CA3 R-LM (-)12000", "CA3 SO-SO (-)00003", "CA3 Trilaminar (-)01113p", "CA2 Pyramidal (+)2333p", "CA2 Basket (-)2232", "CA2 Wide-Arbor Basket (-)2232p", "CA2 Bistratified (-)0313p", "CA2 SP-SR (-)0322", "CA1 Pyramidal (+)2223p", "Cajal-Retzius", "CA1 Radiatum Giant (+)2201", "CA1 Axo-Axonic (-)2232", "CA1 Horizontal Axo-Axonic (-)0012", "CA1 Back-Projection (-)1133p", "CA1 Basket (-)2232", "CA1 Basket CCK+ (-)2232", "CA1 Horizontal Basket (-)0012", "CA1 Bistratified (-)0333", "CA1 Interneuron Specific LMO-O (-)2003", "CA1 Interneuron Specific LM-R (-)2100", "CA1 Interneuron Specific LMR-R (-)2300", "CA1 Interneuron Specific O-R (-)0102", "CA1 Interneuron Specific O-Targeting QuadD (-)2223", "CA1 Interneuron Specific R-O (-)0221", "CA1 Interneuron Specific RO-O (-)0203", "CA1 Ivy (-)0333", "CA1 LMR (-)3300", "CA1 LMR Projecting (-)3300p", "CA1 Neurogliaform (-)3000", "CA1 Neurogliaform Projecting (-)3000p", "CA1 O-LM (-)1002", "CA1 Recurrent O-LM (-)1003", "CA1 O-LMR (-)1102", "CA1 Oriens/Alveus (-)2233", "CA1 Oriens-Bistratified (-)0103", "CA1 Oriens-Bistratified Projecting (-)1113p", "CA1 OR-LM (-)1202", "CA1 Perforant Path-Associated (-)3200p", "CA1 Perforant Path-Associated QuadD (-)3222", "CA1 Quadrilaminar (-)3333", "CA1 Radiatum (-)0300", "CA1 R-Receiving Apical-Targeting (-)1300", "CA1 Schaffer Collateral-Assoc (-)2311", "CA1 Schaffer Collateral-Receiving R-Targeting (-)0322", "CA1 SO-SO (-)0003", "CA1 Hippocampo-Subicular Projecting ENK+ (-)0313p", "CA1 Trilaminar (-)0113p", "CA1 Radial Trilaminar (-)2333", "SUB EC-Projecting Pyramidal (+)331p", "SUB CA1-Projecting Pyramidal (+)331p", "SUB Axo-axonic (-)210", "EC LI-II Multipolar-Pyramidal (+)231000", "EC LI-II Pyramidal-Fan (+)331000p", "MEC LII-III Pyramidal-Multiform (+)233111", "MEC LII Oblique Pyramidal (+)221100", "MEC LII Stellate (+)331111p", "EC LII-III Pyramidal-Tripolar (+)333000p", "LEC LIII Multipolar Principal (+)113330", "MEC LIII Multipolar Principal (+)003310", "EC LIII Pyramidal (+)223111p", "LEC LIII Complex Pyramidal (+)233310", "MEC LIII Complex Pyramidal (+)313300", "MEC LIII Bipolar Complex Pyramidal (+)133100", "EC LIII Pyramidal-Stellate (+)223200p", "EC LIII Stellate (+)223000", "EC LIII-V Bipolar Pyramidal (+)223331", "EC LIV-V Pyramidal-Horizontal (+)220233p", "EC LIV-VI Deep Multipolar Principal (+)000333p", "MEC LV Multipolar-Pyramidal (+)001331", "EC LV Deep Pyramidal (+)220033", "MEC LV Pyramidal (+)331131p", "MEC LV Superficial Pyramidal (+)213330", "MEC LV-VI Pyramidal-Polymorphic (+)000023", "LEC LVI Multipolar-Pyramidal (+)001133", "EC LII Axo-Axonic (-)030000", "MEC LII Basket (-)031000", "EC LII Basket-Multipolar (-)230000", "LEC LIII Multipolar Interneuron (-)023000", "MEC LIII Multipolar Interneuron (-)113220", "MEC LIII Superficial Multipolar Interneuron (-)233000", "EC LIII Pyramidal-Looking Interneuron (-)023300", "MEC LIII Superficial Trilayered Interneuron (-)333000");
	$neuron_group_long2 = array("DG (e)2201p-CA3_00110 Granule", "DG (e)2203p-CA3_00100 Hilar Ectopic Granule", "DG (e)2311p-CA3_00100 Semilunar Granule", "DG (e)0103 Mossy", "DG (e)2323 Mossy MOLDEN", "DG (i)2333 AIPRIM", "DG (i)2233 Axo-axonic", "DG (i)2232 Basket", "DG (i)2232 Basket CCK+", "DG (i)2322 HICAP", "DG (i)1002 HIPP", "DG (i)1333p-CA3_01111 HIPROM", "DG (i)0331 MOCAP", "DG (i)3302 MOLAX", "DG (i)3000 MOPP", "DG (i)3000p-SUB_100 Neurogliaform", "DG (i)3222 Outer Molecular Layer", "DG (i)3303 Total Molecular Layer", "CA3 (e)23223p-CA2_0101-CA1_0101 Pyramidal", "CA3c (e)03223p-DG_0101-CA2_0101-CA1_0101-SUB_100 Pyramidal", "CA3 (e)22010 Giant", "CA3 (e)22100 Granule", "CA3 (i)22232 Axo-axonic", "CA3 (i)00012 Horizontal Axo-axonic", "CA3 (i)22232 Basket", "CA3 (i)22232 Basket CCK+", "CA3 (i)03333 Bistratified", "CA3 (i)01113 Interneuron Specific Oriens", "CA3 (i)03333p-DG_0003 Interneuron Specific Quad", "CA3 (i)03333 Ivy", "CA3 (i)33200 LMR-Targeting", "CA3 (i)02310 Lucidum LAX", "CA3 (i)03311 Lucidum ORAX", "CA3 (i)03300 Lucidum-Radiatum", "CA3 (i)01320p-DG_1100 Spiny Lucidum", "CA3 (i)03330p-DG_0001 Mossy Fiber-Associated", "CA3 (i)02332p-DG_0001 Mossy Fiber-Associated ORDEN", "CA3 (i)11003 O-LM", "CA3 (i)12222 QuadD-LM", "CA3 (i)03000 Radiatum", "CA3 (i)12000 R-LM", "CA3 (i)00003 SO-SO", "CA3 (i)01113p-CA1_0111-SUB_001 Trilaminar", "CA2 (e)2333p-DG_0001-CA3_01011-CA1_0111 Pyramidal", "CA2 (i)2232 Basket", "CA2 (i)2232p-CA3_00030-CA1_0030 Wide-Arbor Basket", "CA2 (i)0313p-CA1__0101 Bistratified", "CA2 (i)0302 SP-SR", "CA1 (e)2223p-SUB_111-EC_000011 Pyramidal", "CA1 (e)3000 Cajal-Retzius", "CA1 (e)2201 Radiatum Giant", "CA1 (i)2232 Axo-axonic", "CA1 (i)0012 Horizontal Axo-axonic", "CA1 (i)1133p-DG_0001-CA3_11101 Back-Projection", "CA1 (i)2232 Basket", "CA1 (i)2232 Basket CCK+", "CA1 (i)0012 Horizontal Basket", "CA1 (i)0333 Bistratified", "CA1 (i)2003 Interneuron Specific LMO-O", "CA1 (i)2100 Interneuron Specific LM-R", "CA1 (i)2300 Interneuron Specific LMR-R", "CA1 (i)0102 Interneuron Specific O-R", "CA1 (i)2223 Interneuron Specific O-Targeting QuadD", "CA1 (i)0221 Interneuron Specific R-O", "CA1 (i)0203 Interneuron Specific RO-O", "CA1 (i)0333 Ivy", "CA1 (i)3300 LMR", "CA1 (i)3300p-DG_1110 LMR Projecting", "CA1 (i)3000 Neurogliaform", "CA1 (i)3000p-DG_3000 Neurogliaform Projecting", "CA1 (i)1002 O-LM", "CA1 (i)1003 Recurrent O-LM", "CA1 (i)1102 O-LMR", "CA1 (i)2233 Oriens\/Alveus", "CA1 (i)0103 Oriens-Bistratified", "CA1 (i)1113p-SUB_111 Oriens-Bistratified Projecting", "CA1 (i)1202 OR-LM", "CA1 (i)3200p-DG_1000-SUB_100 Perforant Path-Associated", "CA1 (i)3222 Perforant Path-Associated QuadD", "CA1 (i)3333 Quadrilaminar", "CA1 (i)0300 Radiatum", "CA1 (i)1300 R-Receiving Apical-Targeting", "CA1 (i)2311 Schaffer Collateral-Associated", "CA1 (i)0322 Schaffer Collateral-Receiving R-Targeting", "CA1 (i)0003 SO-SO", "CA1 (i)0313p-SUB_001 Hippocampo-subicular Projecting ENK+", "CA1 (i)0113p-SUB_111 Trilaminar", "CA1 (i)2333 Radial Trilaminar", "SUB (e)331p-EC_000111 EC-Projecting Pyramidal", "SUB (e)331p-CA1_1110 CA1-Projecting Pyramidal", "SUB (i)210 Axo-axonic", "EC (e)231000 LI-II Multipolar-Pyramidal", "EC (e)331000p-DG_1000-SUB_101 LI-II Pyramidal-Fan", "MEC (e)233111 LII-III Pyramidal-Multiform", "MEC (e)221100 LII Oblique Pyramidal", "MEC (e)331111p-DG_1000-CA3_10000-CA2_1000-SUB_111 LII Stellate", "EC (e)333000p-DG_1000-SUB_111 LII-III Pyramidal-Tripolar", "LEC (e)113330 LIII Multipolar Principal", "MEC (e)003310 LIII Multipolar Principal", "EC (e)223111p-CA1_1000-SUB_100 LIII Pyramidal", "LEC (e)233310 LIII Complex Pyramidal", "MEC (e)313300 LIII Complex Pyramidal", "MEC (e)133100 LIII Bipolar Complex Pyramidal", "EC (e)223200p-CA1_1000-SUB_100 LIII Pyramidal-Stellate", "EC (e)223000 LIII Stellate", "EC (e)223331 LIII-V Bipolar Pyramidal", "EC (e)220233p-DG_1000 LIV-V Pyramidal-Horizontal", "EC (e)000333p-SUB_111 LIV-VI Deep Multipolar Principal", "MEC (e)001331 LV Multipolar-Pyramidal", "EC (e)220033 LV Deep Pyramidal", "MEC (e)331131p-DG_1100-SUB_101 LV Pyramidal", "MEC (e)213330 LV Superficial Pyramidal", "MEC (e)000023 LV-VI Pyramidal-Polymorphic", "LEC (e)001133 LVI Multipolar-Pyramidal", "EC (i)030000 LII Axo-axonic", "MEC (i)031000 LII Basket", "EC (i)230000 LII Basket-Multipolar Interneuron", "LEC (i)023000 LIII Multipolar Interneuron", "MEC (i)113220 LIII Multipolar Interneuron", "MEC (i)233000 LIII Superficial Multipolar Interneuron", "EC (i)023300 LIII Pyramidal-Looking Interneuron", "MEC (i)333000 LIII Superficial Trilayered Interneuron");
	$neuron_ids = array('1000', '1041', '1001', '1002', '1043', '1027', '1010', '1035', '1036', '1009', '1013', '1026', '1040', '1005', '1008', '1007', '1006', '1004', '2000', '2004', '2003', '2001', '2028', '2047', '2043', '2044', '2045', '2021', '2042', '2046', '2005', '2017', '2013', '2014', '2019', '2036', '2035', '2009', '2049', '2023', '2008', '2022', '2020', '3000', '3006', '3007', '3003', '3008', '4000', '4094', '4054', '4036', '4038', '4023', '4078', '4079', '4039', '4080', '4022', '4021', '4056', '4031', '4020', '4091', '4093', '4081', '4005', '4004', '4012', '4011', '4069', '4089', '4087', '4055', '4083', '4068', '4066', '4006', '4076', '4003', '4028', '4061', '4015', '4084', '4033', '4041', '4035', '4013', '5001', '5005', '5002', '6094', '6005', '6008', '6019', '6003', '6082', '6025', '6031', '6017', '6007', '6006', '6024', '6092', '6018', '6095', '6085', '6086', '6033', '6021', '6002', '6023', '6052', '6078', '6048', '6096', '6053', '6049', '6047', '6040', '6087', '6038');
	$parcel_ids = array('DG_SMo', 'DG_SMo', 'DG_SMi', 'DG_SMi', 'DG_SG', 'DG_SG', 'DG_H', 'DG_H', 'DG_All', 'DG_All', 'CA3_SP', 'CA3_SP', 'CA3_SL', 'CA3_SL', 'CA3_SR', 'CA3_SR', 'CA3_SLM', 'CA3_SLM', 'CA3_SO', 'CA3_SO', 'CA3_All', 'CA3_All', 'CA2_All', 'CA2_All', 'CA2_SO', 'CA2_SO', 'CA2_SP', 'CA2_SP', 'CA2_SR', 'CA2_SR', 'CA2_SLM', 'CA2_SLM', 'CA1_SLM', 'CA1_SLM', 'CA1_SR', 'CA1_SR', 'CA1_SP', 'CA1_SP', 'CA1_SO', 'CA1_SO', 'CA1_All', 'CA1_All', 'Sub_SM', 'Sub_SM', 'Sub_SP', 'Sub_SP', 'Sub_PL', 'Sub_PL', 'Sub_All', 'Sub_All', 'EC_I', 'EC_I', 'EC_II', 'EC_II', 'EC_III', 'EC_III', 'EC_IV', 'EC_IV', 'EC_V', 'EC_V', 'EC_VI', 'EC_VI', 'EC_All', 'EC_All');
	// Collect neuron types and sort them
	$neuron_type_unsorted = array();
	$neuron_parcel_unsorted = array();
	$neuron_parcel_counts = array();
	$sql = "SELECT DISTINCT hippocampome_neuronal_class, subregion FROM neurite_quantified;";
	$result = $conn->query($sql);
	$nt_tot = 0;
	$nt_tot_old = 0;
	if ($result->num_rows > 0) { 
		while($row = $result->fetch_assoc()) {
		  $neuron_type = $row['hippocampome_neuronal_class'];
		  if ($neuron_type != '') {
		    array_push($neuron_type_unsorted, $neuron_type);
		    array_push($neuron_parcel_unsorted, $row['subregion']);
		  }
		}
	}
	$number_of_parcels = sizeof($vert_parcel_group);
	//$neuron_group = array_fill(0, sizeof($neuron_type_unsorted), 0);
	for ($v_i = 0; $v_i < $number_of_parcels; $v_i++) {  
		for ($ng_i = 0; $ng_i < sizeof($neuron_type_unsorted); $ng_i++) {
		  if ($neuron_parcel_unsorted[$ng_i] == $vert_parcel_group[$v_i]) {
		    //$neuron_group[$nt_tot] = $neuron_type_unsorted[$ng_i];
		    $nt_tot++;
		  }
		}
		if (sizeof($neuron_parcel_counts)==0) {
		  array_push($neuron_parcel_counts, $nt_tot);
		  $nt_tot_old = $nt_tot;
		}
		else {
		  array_push($neuron_parcel_counts, ($nt_tot-$nt_tot_old));
		  $nt_tot_old = $nt_tot;
		}
	}

	for ($i = 0; $i < count($parcel_group); $i++) {
		$parcel_delim = explode(':', $parcel_group[$i]);
		array_push($parcel_region, $parcel_delim[0]);
		array_push($parcel_layers, $parcel_delim[1]);
		array_push($parcel_a_d, $parcel_delim[2]);
	}	
?>	