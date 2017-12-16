<?php
Session_start();
// WHEEL OF FORTUNE (Project 2) Starter Kit
// J. Michael Moshell - 13 Sept 2012



$Category = "Dig3134-Project 2";

# list of words (phrases) to guess below, separated by new line
$list = "PERFECT
KNIGHTS RULE
LOVE IS BLIND
IT TAKES TWO TO TANGO
DIGITAL MEDIA";


# make sure that any characters to be used in $list are in either
#   $alpha OR $additional_letters, but not in both.  It may not work if you change fonts.
#   You can use either upper OR lower case of each, but not both cases of the same letter.

# below ($alpha) is the alphabet letters to guess from.
#   you can add international (non-English) letters, in any order, such as in:
#   $alpha = "���������������������������ݟABCDEFGHIJKLMNOPQRSTUVWXYZ";
$alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

# below ($additional_letters) are extra characters given in words; '?' does not work
#   these characters are automatically filled in if in the word/phrase to guess
$additional_letters = " -.,;!?%&0123456789";

#========= do not edit below here ======================================================


print<<<endHTML
<HTML><HEAD><TITLE>Play PHP Hangman Game</TITLE>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css">
<style type="text/css">
<!--
	body{background-image:url("background.gif"); background-repeat: no-repeat; background-position: center;}
	H1		{font-family: "Courier New", Courier, monospace; font-size: 18pt;}
	P		{font-family: Verdana, Arial, sans-serif; font-size: 12pt;}
	A:link	{COLOR: yellow; TEXT-DECORATION: underline;}
	A:visited	{COLOR: purple; TEXT-DECORATION: underline;}
	A:active	{COLOR: purple; TEXT-DECORATION: underline;}
	A:hover	{COLOR: white; TEXT-DECORATION: underline;}
-->
</style>
</HEAD>

<BODY bgColor="black" link="navy" vlink="navy" alink="navy">
<DIV ALIGN="center">
endHTML;

$len_alpha = strlen($alpha);

if(isset($_GET["n"])) $n=$_GET["n"];
if(isset($_GET["letters"])) $letters=$_GET["letters"];
if(!isset($letters)) $letters="";

if(isset($PHP_SELF)) $self=$PHP_SELF;
else $self=$_SERVER["PHP_SELF"];

$links="";



$max=6;					# maximum number of wrong
# error_reporting(0);
$list = strtoupper($list);
$words = explode("\n",$list);
srand ((double)microtime()*1000000);
$all_letters=$letters.$additional_letters;
$wrong = 0;

print "<P><B>Play PHP Hangman Game</B> &nbsp; - &nbsp; <B>$Category</B><BR>\n";

if (!isset($n)) { $n = rand(1,count($words)) - 1; }
$word_line="";
$word = trim($words[$n]);
$done = 1;
for ($x=0; $x < strlen($word); $x++)
{
  if (strstr($all_letters, $word[$x]))
  {
    if ($word[$x]==" ") $word_line.="&nbsp; "; else $word_line.=$word[$x];
  } 
  else { $word_line.="_<font size=3>&nbsp;</font>"; $done = 0; }
}

if (!$done)
{

  for ($c=0; $c<$len_alpha; $c++)
  {
    if (strstr($letters, $alpha[$c]))
    {
      if (strstr($words[$n], $alpha[$c])) {$links .= "\n<B>$alpha[$c]</B> "; }
      else { $links .= "\n<FONT color=\"purple\">$alpha[$c] </font>"; $wrong++; }
    }
    else
    { $links .= "\n<A HREF=\"$self?letters=$alpha[$c]$letters&n=$n\">$alpha[$c]</A> "; }
  }
  $nwrong=$wrong; if ($nwrong>6) $nwrong=6;
  print "\n<p><BR>\n<IMG SRC=\"hangman_$nwrong.gif\" ALIGN=\"MIDDLE\" BORDER=0 WIDTH=100 HEIGHT=100 ALT=\"Wrong: $wrong out of $max\">\n";

  if ($wrong >= $max)
  {
    $n++;
    if ($n>(count($words)-1)) $n=0;
    print "<BR><BR><H1><font size=5>\n$word_line</font></H1>\n";
    print "<p><BR><FONT color=\"purple\"><BIG>SORRY, YOU ARE HANGED!!!</BIG></FONT><BR><BR>";
    if (strstr($word, " ")) $term="phrase"; else $term="word";
    print "<FONT color=\"white\">The $term was \"<B>$word</B>\"</FONT><BR><BR>\n";
    print "<A HREF=$self?n=$n>Play again.</A>\n\n";
  }
  else
  {
    print " &nbsp; # Wrong Guesses Left: <B>".($max-$wrong)."</B><BR>\n";
    print "<H1><font size=5>\n$word_line</font></H1>\n";
    print "<P><BR>Choose a letter:<BR><BR>\n";
    print "$links\n";
  }
}
else
{
  $n++;	# get next word
  if ($n>(count($words)-1)) $n=0;
  print "<BR><BR><H1><font size=5>\n$word_line</font></H1>\n";
  print "<P><BR><BR><B>Congratulations!!! &nbsp;You win!!!</B><BR><BR><BR>\n";
  print "<A HREF=$self?n=$n>Play again</A>\n\n";
}


print<<<endHTML


<p align="center"><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><font face="Verdana" size="3" color="white">Thank you for playing PHP Hangman Game - Brought to you by Gina Levy<br></font>



</DIV></BODY></HTML>


endHTML;
?>
