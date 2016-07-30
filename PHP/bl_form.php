<html>
<body>
    <form method="POST" action="bl_process.php">
        <input type='text' name='server' value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
        <input type='submit' />
    </form>
    <hr>



	<h2>Test Values</h2>
	<p>To test your application you may query the http:BL DNS system with certain IPs that have predefined responses. <br>The table below outlines the IPs you can query and the response you should expect.</p>
	<div style="margin-left: 30px;">
	    <table border="1px" cellpadding="5px" cellspacing="0px">
	        <tr>
	            <td colspan="2"><strong>SIMULATE NO RECORD RETURNED</strong></td>
	        </tr>
	        <tr>
	            <td align="center"><strong><u>Query</u></strong></td>
	            <td align="center"><strong><u>Expected Response</u></strong></td>
	        </tr>
	        <tr>
	            <td align="center">127.0.0.1</td>
	            <td align="center">NXDOMAIN</td>
	        </tr>
	        <tr>
	            <td colspan="2"><strong>SIMULATE DIFFERENT TYPES</strong></td>
	        </tr>
	        <tr>
	            <td align="center"><strong><u>Query</u></strong></td>
	            <td align="center"><strong><u>Expected Response</u></strong></td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.0</td>
	            <td align="center">127.1.1.0</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.1</td>
	            <td align="center">127.1.1.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.2</td>
	            <td align="center">127.1.1.2</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.3</td>
	            <td align="center">127.1.1.3</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.4</td>
	            <td align="center">127.1.1.4</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.5</td>
	            <td align="center">127.1.1.5</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.6</td>
	            <td align="center">127.1.1.6</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.1.7</td>
	            <td align="center">127.1.1.7</td>
	        </tr>
	        <tr>
	            <td colspan="2"><strong>SIMULATE DIFFERENT THREAT LEVELS</strong></td>
	        </tr>
	        <tr>
	            <td align="center"><strong><u>Query</u></strong></td>
	            <td align="center"><strong><u>Expected Response</u></strong></td>
	        </tr>
	        <tr>
	            <td align="center">127.1.10.1</td>
	            <td align="center">127.1.10.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.20.1</td>
	            <td align="center">127.1.20.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.40.1</td>
	            <td align="center">127.1.40.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.1.80.1</td>
	            <td align="center">127.1.80.1</td>
	        </tr>
	        <tr>
	            <td colspan="2"><strong>SIMULATE DIFFERENT NUMBER OF DAYS</strong></td>
	        </tr>
	        <tr>
	            <td align="center"><strong><u>Query</u></strong></td>
	            <td align="center"><strong><u>Expected Response</u></strong></td>
	        </tr>
	        <tr>
	            <td align="center">127.10.1.1</td>
	            <td align="center">127.10.1.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.20.1.1</td>
	            <td align="center">127.20.1.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.40.1.1</td>
	            <td align="center">127.40.1.1</td>
	        </tr>
	        <tr>
	            <td align="center">127.80.1.1</td>
	            <td align="center">127.80.1.1</td>
	        </tr>
	    </table>
	</div>

</body>
</html>
