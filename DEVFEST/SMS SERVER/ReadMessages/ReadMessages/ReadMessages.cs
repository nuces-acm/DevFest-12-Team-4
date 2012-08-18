/*
Irfan Ul Haq
03455225983
haq.irfan89@gmail.com
 
*/
 

using System;
using System.Collections.Generic;
using System.Text;
using System.Collections;
using System.Threading;
using org.smslib;
using org.smslib.modem;
using System.Net;
using System.IO;

namespace ReadMessages
{
	class ReadMessages
	{
	static Service srv;
		public class InboundNotification : IInboundMessageNotification
		{
			string url;
			bool a = false;
			public void postData(AGateway gateway, InboundMessage msg, String[] mssg)
				{
				if(mssg.Length == 7)
					{
					//means complete message with login key
					url = "http://localhost/devfest/geocode.php?key=" + mssg[1] + "&name=" + mssg[2] + "&cnic=" + mssg[3]
						+ "&location=" + mssg[4].Trim() + "&disease=" + mssg[5] + "&contact=" + mssg[6];
					a = false;
					}
				else if(mssg.Length == 2)
					{
					//just to identify that key is correct. not used yet
					}
				else if(mssg.Length == 5)
					{
					url = "http://localhost/devfest/geocodee.php?name=" + mssg[1] + "&cnic=" + mssg[2]
						+ "&location=" + mssg[3].Trim() + "&disease=" + mssg[4] + "&contact=" + msg.getOriginator();
					a = true;
					//means complete message without login key
					}

				WebRequest request = HttpWebRequest.Create(url);

				WebResponse response = request.GetResponse();

				StreamReader reader = new StreamReader(response.GetResponseStream());

				string urlText = reader.ReadToEnd();
				Console.WriteLine(urlText);
				
				try
					{
					// Uncomment following line if you wish to delete the message upon arrival.
					gateway.deleteMessage(msg);

					}
				catch(Exception e)
					{
					Console.WriteLine("Oops!!! Something gone bad...");
					Console.WriteLine(e.Message);
					Console.WriteLine(e.StackTrace);
					}
				OutboundMessage msg1 = new OutboundMessage("+"+msg.getOriginator(), urlText);
				srv.sendMessage(msg1);
				if(a)
					{
					checkThreats(mssg[4],mssg[3].Trim(),msg);
					}
				else
					{
					checkThreats(mssg[5],mssg[4].Trim(),msg);
					}
				}

			public void checkThreats(string desease,string location, InboundMessage msg)
				{
				if(desease.ToLower().Contains("dengue"))
					{
					url = "http://localhost/devfest/geocode.php?disease=" + desease + "&location="+location;
					WebRequest request = HttpWebRequest.Create(url);

					WebResponse response = request.GetResponse();

					StreamReader reader = new StreamReader(response.GetResponseStream());

					string urlText = reader.ReadToEnd();
					if(urlText.Equals("alert")){
						//Here the Alerts will be sent. For test case I am sending alert to my team member
					OutboundMessage msg1 = new OutboundMessage("+923025474347", "Dengue Alert!!!\n Dengue is Spreading near "+location);
					srv.sendMessage(msg1);
					Console.WriteLine("Dengue Alert!!!\n Dengue is Spreading near " + location);
						}
					}
				}

			public void process(AGateway gateway, org.smslib.Message.MessageTypes msgType, InboundMessage msg)
			{
				string message = msg.getText().Trim();
				if(message.Substring(0,2).Equals("p?",StringComparison.OrdinalIgnoreCase))
					{
					Console.WriteLine(message);
					String[] mssg = message.Split('?');
					postData(gateway, msg, mssg);
					}
			}
		}

		public class GatewayStatusNotification : IGatewayStatusNotification
		{
			public void process(AGateway gateway, org.smslib.AGateway.GatewayStatuses oldStatus, org.smslib.AGateway.GatewayStatuses newStatus)
			{
				Console.WriteLine("\n>>> Gateway Status change for " + gateway.getGatewayId() + ", OLD: " + oldStatus + " -> NEW: " + newStatus);
			}
		}
		
		public void DoIt()
		{
			// Create new Service object - the parent of all and the main interface to you.
			
			srv = Service.getInstance();

			// *** The tricky part ***
			// *** Comm2IP Driver ***
			// Create (and start!) as many Comm2IP threads as the modems you are using.
			// Be careful about the mappings - use the same mapping in the Gateway definition.
			Comm2IP.Comm2IP com1 = new Comm2IP.Comm2IP(new byte[] { 127, 0, 0, 1 }, 12000, "com20", 115200);

			try
			{
				//Console.WriteLine("");
				Console.WriteLine("Library Version: " + Library.getLibraryVersion());
				Console.WriteLine("Please wait while server is initialising...");
				// Start the COM listening thread.
				new Thread(new ThreadStart(com1.Run)).Start();
				Console.Write("||");
				// Lets set some callbacks.
				srv.setInboundMessageNotification(new InboundNotification());
				Console.Write("||");
				//srv.setOutboundMessageNotification(new OutboundNotfication());
				Console.Write("||");
				//srv.setCallNotification(new CallNotification());
				srv.setGatewayStatusNotification(new GatewayStatusNotification());
				Console.Write("||");

				// Create the Gateway representing the serial GSM modem.
				// Due to the Comm2IP bridge, in SMSLib for .NET all modems are considered IP modems.
				IPModemGateway gateway = new IPModemGateway("modem.com20", "127.0.0.1", 12000, "Huawei", "E220");
				Console.Write("||");
				gateway.setIpProtocol(ModemGateway.IPProtocols.BINARY);
				Console.Write("||");
				// Set the modem protocol to PDU (alternative is TEXT). PDU is the default, anyway...
				gateway.setProtocol(AGateway.Protocols.PDU);
				Console.Write("||");
				// Do we want the Gateway to be used for Inbound messages?
				gateway.setInbound(true);
				Console.Write("||");
				// Do we want the Gateway to be used for Outbound messages?
				gateway.setOutbound(true);
				
				Console.Write("||");
				// Let SMSLib know which is the SIM PIN.
				gateway.setSimPin("0000");
				Console.Write("||");
				//This Smsc number is of warid. Adjust accordingly
				//only use for sms sending pourose.
				gateway.setSmscNumber("+923210006001");
				Console.Write("||");
				// Add the Gateway to the Service object.
				srv.addGateway(gateway);
				Console.Write("||");
				// Similarly, you may define as many Gateway objects, representing
				// various GSM modems, add them in the Service object and control all of them.
				Console.Write("||");
				// Start! (i.e. connect to all defined Gateways)
				srv.startService();
				Console.WriteLine();
				Console.WriteLine("Modem Information:");
				Console.WriteLine("  Manufacturer: " + gateway.getManufacturer());
				Console.WriteLine("  Model: " + gateway.getModel());
				Console.WriteLine("  Serial No: " + gateway.getSerialNo());
				Console.WriteLine("  SIM IMSI: " + gateway.getImsi());
				Console.WriteLine("  Signal Level: " + gateway.getSignalLevel() + "dBm");
				Console.WriteLine("  Battery Level: " + gateway.getBatteryLevel() + "%");
				
				Console.WriteLine();
				Console.WriteLine("Press <ENTER> to terminate...");
				Console.In.ReadLine();
			}
			catch (Exception e)
			{
			Console.WriteLine("Some thing went wrong here");
				Console.WriteLine(e.Message);
				Console.WriteLine(e.StackTrace);
			}
			finally
			{
				com1.Stop();
				srv.stopService();
			}
		}
		public void sendMessage(String message, String number)
			{
			OutboundMessage msg = new OutboundMessage(number, message);
			srv.sendMessage(msg);
			}
		static void Main(string[] args)
		{
			ReadMessages app = new ReadMessages();
			app.DoIt();
		}
	}
}
