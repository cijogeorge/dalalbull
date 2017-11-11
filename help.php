<?php
$con=mysql_connect("localhost","inexcel_excel","excel2k9");
if (!$con)
{
 die('Could not connect: ' . mysql_error());
}
mysql_select_db("inexcel_excel",$con);
?>
<html>
<head>
<link rel="shortcut icon" href="small.gif" mce_href="favicon.ico" >
<title>DALAL BULL</title>
</head>
<body><center>
<h1>DALAL BULL @ e<font color="red">X</font>cel 2k9</h1>
<?
$excelid=$_POST['excelid'];
$password=$_POST['password'];
mysql_real_escape_string($excelid);
mysql_real_escape_string($password);
$temp1=mysql_query("SELECT excelid FROM `portfolio` WHERE excelid='$excelid' AND password='$password'");
$temp2=mysql_fetch_array($temp1);
if(!$temp2)
{ 
 ?><form name="form" action="login.php" method="post">
 <hr>Authentication failure.<br><br>
 <input type="submit" name="back" value="Login">
 </form><?
}
else
{

 ?>
 <table>
 <tr>
 <td><form name="form2" action="portfolio.php" method="post">
 <input type="submit" name="portfolio" value="Portfolio">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form1" action="stockinfo.php" method="post">
 <input type="submit" name="stockinfo" value="Stock Info">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form3" action="buy.php" method="post">
 <input type="submit" name="buy" value="Buy / Short Sell">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form4" action="sell.php" method="post">
 <input type="submit" name="sell" value="Sell / Short Cover">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form8" action="history.php" method="post">
 <input type="submit" name="history" value="History">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form7" action="ranklist.php" method="post">
 <input type="submit" name="ranklist" value="Top Ranks">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form10" action="change_pass.php" method="post">
 <input type="submit" name="change_pass" value="Change Pass">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form9" action="help.php" method="post">
 <input type="submit" name="help" value="Help">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form5" action="help.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 <input type="hidden" name="help" value="<?echo $_POST['help'];?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table> <hr></center>
 <br>
 <b>What is a Share/Stock ?</b>
 <p>
In simple words, a share or stock is a document issued by a company, which entitles its holder to be one of the owners of the company. A share is issued by a company or can be purchased from the stock market.
 </p><p>
By owning a share you get a portion of the company and by selling shares you get capital gain if the price of the share while selling is higher than the price at the time you bought the share. So, your return is the dividend plus the capital gain. However, you also run a risk of making a capital loss if you have to sell the share at a price below your buying price.
 </p><p>
A company's stock price reflects what investors think about the stock, not necessarily what the company is "worth." For   example, companies that are growing quickly often trade at a price higher than the company might currently be "worth." Stock prices are also affected by all forms of company and market news. Publicly traded companies are required to report quarterly on their financial status and earnings. Market forces and general investor opinions can also affect share price.
 </p>
 <b>What is a DEMAT account ?</b>
 <p>  
Just as you have to open an account with a bank if you want to save your money, make cheque payments etc, nowadays, you need to open a DEMAT account if you want to buy or sell stocks.
 </p><p>
So it is just like a bank account where actual money is replaced by shares. You have to approach the DPs (Depository Participant) (Remember; they are like Bank Branches), to open your demat account. <br>Let's say, your portfolio of shares looks like this: 150 of Infosys, 50 of Wipro, 200 of HLL and 100 of ACC. All these will show in your DEMAT account. So you don't have to possess any physical certificates showing that you own these shares. They are all held electronically in your account. As you buy and sell the shares, they are adjusted in your account. Just like a bank passbook or statement, the DP will provide you with periodic statements of holdings and transactions.
 </p>
 <b>Who is a Stock Broker ?</b>
 <p>
A Stock Broker is a person or a Firm that trades on its clients' behalf. You tell them what you want to invest in and they will issue the transaction order. You will have to pay brokerage for the service of the broker. Some stock brokers also give out financial advice for which you are charged extra.
 </p>
 <b>Types of transactions other than Buying & Selling</b>
 <br><br>
 <b>Short Sell</b>
 <p>
When an investor goes LONG on an investment, it means he/she has bought a stock believing its price will rise in the future. Conversely, when an investor goes SHORT, he is anticipating a decrease in share price.
 </p><p>
Short selling is the selling of a stock that the seller doesn't own. More specifically, a short sale is the sale of a security that isn't owned by the seller, but that is promised to be delivered. That may sound confusing, but it's actually a simple concept.
 </p><p>
Still with us? Here's the skinny: when you Short Sell a stock, your broker will lend it to you. The stock will come from the broker's own inventory, from another one of the Firm's customers, or from another brokerage Firm. The shares are sold and the proceeds are credited to your account. Sooner or later you must "close" the short by buying back the same number of shares (called Covering) and returning them to your broker. If the price drops, you can buy back the stock at the lower price and make a profit on the difference. If the price of the stock rises, you have to buy it back at the higher price, and you lose money. 
 </p>
 <b>Short Cover</b>
 <p>
This is the process by which you buy the shares that you already sold. First you sell and then you buy (just the opposite of the actual transaction of buy and then sell). But the catch is, when the market closes at 15.30, all the shares that you have Short Sold & not Short Covered, will automatically be Short Covered (i.e. bought back).
 </p>
 <b>Limit Trading and Market Trading</b>
 <p>
Limit Trading - When you start playing the game you will see a form that says pending order,well this is what limit trading is all about. Here you may mention a price at which you want the shares to be bought or sold if you are not happy with the current price. In DALAL BULL, all the pending transactions that has not yet executed will be cancelled automatically when the market closes (i.e. at 15.30). So your limit better reach the target before 15.30. You will have to pay brokerage only for the executed transactions.
 </p><p>
 <i>Example: </i>Let's say that the shares of company ABC is at Rs 10, but you just have 9 Rupees with you. Here you may place a pending order, that you want the shares at Rs 9. When the price reaches your target it will be bought (otherwise no transaction will take place). Likewise for Sell, Short Sell and Short Cover.
</p><p>
On the other hand, you have market trading. Yes, you guessed it. You trade straight away without keeping any limit. Here your transaction will take place at the current price. 
 </p>
 <b>Terminology used in DALAL BULL</b>
 <br><br>
 <b>Stock Info</b>
 <p>
DALAL BULL provides stock info for 50 companies from the NSE & you are allowed to trade with these companies only.
The table displayed contains the following information.
 <br><br>
 <i>Current price:</i> Shows the current price of the share.<br><br>
 <i>Open:</i> Price at which first trade of the day takes place.<br><br>
 <i>High:</i> Highest price during the day.<br><br>
 <i>Low:</i> Lowest price during the day.<br><br>
 <i>Prev. Close:</i> Weighted avg. price of the last few minutes of trade.<br><br>
 <i>Total traded quantity:</i> Total no. of shares traded during the day. 
 </p>
 <b>Cash Balance</b>
 <p>
This includes the Cash In Hand and the Margin you deposit after Short Selling.
 </p>
 <b>Cash In Hand</b> 
 <p>
Initially you get an amount of Rs.1000000 to invest. As you buy you loose cash. Guess you can make out about Sell, Short Sell and Short Cover. This is the amount with with you can trade at any point of time. It doesnt include the Margin deposited in case there are Short Sold shares.
 </p>
 <b>Margin</b>
 <p>
While Short Selling N number of shares, you will have to keep a margin in the broker's inventory (sort of a deposit). It is calculated as: say you bought N number of shares at Rs.10 each. You have to deposit with the broker an amount of Rs.(N*10)/2), which you will get back when you Short Cover. This is to ensure that you will have enough money to Short Cover even if the company share gains by 50%. 
 </p>
 <b>Net Worth</b> 
 <p>
Net worth includes the Cash In Hand, Margin and the total current worth of all your stocks.
RANKING IS BASED ON NET WORTH.
 </p>
 <b>No. of Transactions</b>
 <p>
It is the total number of transactions made by the broker on your behalf. The brokerage you pay is a percentage which depends on the number of transactions you carry out. So if the number of transactions are more, you will see that the brockerage we take also increases. 
</p><p>
<b>Brokerage</b>
<p>
In DALAL BULL the brokerage would be 0.1% per share for first 100 transactions, 0.2% per share for next 900 transactions, and 0.5 % per share for any number of transactions above 1000. This helps in effectively reducing the number of transactions carried out by a person, hence limiting the number of gambles.
 </p>
 <b>Expected Gain %</b>
 <p>
It is the profit/loss % that you will make per share if you Sell/Short Cover at that point of time.
 </p>
 <center>
<?
 mysql_close($con);
}
?><br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>

