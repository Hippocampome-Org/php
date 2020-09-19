#!/bin/bash

max_lines=4500;
input_file1=query_results_gs2;
input_file2=query_results_gs5;
input_file3=query_results_gs29;
input_file4=query_results_pm30;
input_file5=query_results_pm66;
input_path1=/var/www/html/cognome/php/cognome/lit_rev/extract_citations/gs_results/csv_results/$input_file1.csv;
input_path2=/var/www/html/cognome/php/cognome/lit_rev/extract_citations/gs_results/csv_results/$input_file2.csv;
input_path3=/var/www/html/cognome/php/cognome/lit_rev/extract_citations/gs_results/csv_results/$input_file3.csv;
input_path4=/var/www/html/cognome/php/cognome/lit_rev/extract_citations/pubmed_results/30/$input_file4.csv;
input_path5=/var/www/html/cognome/php/cognome/lit_rev/extract_citations/pubmed_results/66/$input_file5.csv;
cropped_dir=temp_cropped/;
output_dir=temp_output/;
results_dir=results/;
cropped_file1=$cropped_dir$input_file1"_crop.csv";
cropped_file2=$cropped_dir$input_file2"_crop.csv";
cropped_file3=$cropped_dir$input_file3"_crop.csv";
cropped_file4=$cropped_dir$input_file4"_crop.csv";
cropped_file5=$cropped_dir$input_file5"_crop.csv";
mod_file1=$output_dir$input_file1"_crop_mod.csv";
mod_file2=$output_dir$input_file2"_crop_mod.csv";
mod_file3=$output_dir$input_file3"_crop_mod.csv";
mod_file4=$output_dir$input_file4"_crop_mod.csv";
mod_file5=$output_dir$input_file5"_crop_mod.csv";
output_file=combined_results.csv;

# crop files
head --lines=$max_lines $input_path1 > $cropped_file1;
head --lines=$max_lines $input_path2 > $cropped_file2;
head --lines=$max_lines $input_path3 > $cropped_file3;
head --lines=$max_lines $input_path4 > $cropped_file4;
head --lines=$max_lines $input_path5 > $cropped_file5;

# select columns
php output_titles_gs.php $cropped_file1;
php output_titles_gs.php $cropped_file2;
php output_titles_gs.php $cropped_file3;
php output_titles_pm.php $cropped_file4;
php output_titles_pm.php $cropped_file5;

# combine results
echo "title,year" > $results_dir$output_file;
cat $mod_file1 $mod_file2 $mod_file3 $mod_file4 $mod_file5 >> $results_dir$output_file;

# clean up temp files
rm $cropped_dir/*
rm $output_dir/*