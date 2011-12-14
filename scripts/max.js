// JavaScript Document

//THIS  SCRIPT CONTROLS THE ENTIRE FRONTEND INTERACTIONS OF DEADLOCK ARENA
var NavigatorTopLeft,NavigatorTopRight,NavigatorBottomLeft,NavigatorBottomRight;
function checkSession()
	{
		$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_session_management.php?action=validate+session",
					cache:false,
					success:function(jsonData)	{
													jsonData = $.parseJSON(jsonData);
													if(jsonData.Status=="Logged Out")
														{
															//Actions on log out
														}
													else if(jsonData.Status=="Logged In")
														{
															//Actions on login
														}
													else
														{
														
															//Error return 
														}
												}
				}
			);
	}
function LogOut()
	{
				$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_session_management.php?action=log+out",
					cache:false,
					success:function(jsonData)	{
													alert(jsonData);
													if(jsonData.Status=="Logged Out")
														{
															//A redirection to techkShetra.com
															//Actions on log out
														}
													else
														{
															$("#Status").html("Oops! Just give another try. Seems the server is crying!!");
															//Error return 
														}
												}
				}
			);
	}

function  displayNavigator()
	{			
				$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_user_navigations.php?NavigationAction=display+navigator",
					cache:false,
					success:function(jsonData)	{
													
													
													jsonData  = $.parseJSON(jsonData);
													NavigatorTopLeft = jsonData.TopLeft;
													NavigatorTopRight = jsonData.TopRight;
													NavigatorBottomLeft = jsonData.BottomLeft;
													NavigatorBottomRight = jsonData.BottomRight;
													
												}
				}
			);
	}

function navigateTo(direction)
	{
				$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_user_navigations.php?NavigationAction=navigate+to",
					data:{direction:direction},
					cache:false,
					success:function(jsonData)	{
													alert(jsonData);
													if(jsonData.Status=="NAVIGATION_SUCCESS")
														{
															$("Status").html("Hmm!! You know the paths..");
															//Render the question again
															//Actions on successful navigation
														}
													else if(jsonData.Status=="NAVIGATION_FAIL")
														{
															$("Status").html("Okay!! Just one thing we know. You can't do this..");
															//Actions on failure
														}
													else
														{	
														$("#Status").html("Oops! Just give another try. Seems the server is crying!!");
															//Error return 
														}
												}
				}
			);
	}

function answerValidation(answer)
	{
		$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_answer_validation.php",
					data:{Answer:answer},
					cache:false,
					success:function(jsonData)	{
													alert(jsonData);
													if(jsonData.Status=="LEVEL UP")
														{
															$jsonData = displayNavigator();
															if($jsonData.BottomLeft==0&&$json.BottomRight==0)
																{
																	$("Status").html("Fantastic!! You are in a Deadlock");
																}
															else
																{
																	$("Status").html("Oops!! You just evolved!!");
																	displayNavigator();
																	//safe and sound u rock!!
																}
														}
													else if(jsonData.Status=="TRY AGAIN")
														{
															$("Status").html("Okay! Let us do this again!!");
															//Actions on try again
														}
													else
														{
															$("#Status").html("Oops! Just give another try. Seems the server is crying!!");
															//Error return 
														}
												}
				}
			);
	}
function questionRender()
	{
		checkSession();
		$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_question_rendering.php",
					cache:false,
					success:function(jsonData)	{
													document.write(jsonData);
													//Output the html to a div / iframe, iframe would be brilliant
												}
				}
			);
	}

function Login()
	{
		
		$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_user_login.php?action=login",
					cache:false,
					success:function(jsonData)	{
													//Output the html to a div
													
													var outdata = $.parseJSON(jsonData);
													if(outdata.Status=="Login")
														{
															// code for user login at the techKshetra Account
														}
													else if(outdata.Status=="Welcome")
														{
																
																GetDetails()																
																
																$("#Status").html("Welcome To Deadlock Evolution");
																//Also write a function retrieve all user information from techKshetra front end
																//A redirecton to welocme to deadlock for the first time page
														}
													else if(outdata.Status=="Welcome Back")
														{
															GetDetails();
															
															$("#Status").html("Welcome back to Deadlock Evolution");
															//A redirection to the arena
														}
													else	
														{
															$("Status")
															$("#Status").html("Oops! Just give another try. Seems the server is crying!!");
															// its probably a server error
														}
												}
				}
			);
	}

function GetDetails()
	{
		$.ajax(
			   	{
					url:"../../reg/frontend/inferno.php?action=detail",
					cache:false,
					success:function(jsonData)
											{
																								
												jsonData = $.parseJSON(jsonData);
												$("#FirstName").html(jsonData.FirstName);
												//Function to process returned events list
											}
				}
			   );
	}

function showAnswerPane()
	{
		
		$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_user_navigations.php?NavigationAction=display+navigator",
					cache:false,
					success:function(jsonData)	{
													
													
													jsonData  = $.parseJSON(jsonData);
													NavigatorTopLeft = jsonData.TopLeft;
													NavigatorTopRight = jsonData.TopRight;
													NavigatorBottomLeft = jsonData.BottomLeft;
													NavigatorBottomRight = jsonData.BottomRight;
													
														$("#AnswerBox").hide();
		$("#Solved").hide();
		if(NavigatorBottomLeft=="NULL"&&NavigatorBottomRight=="NULL")
			{
				$("#AnswerBox").fadeIn(100);
				//Display solved in answer box
			}
		else
			{
				$("#Solved").fadeIn(100);
				//Display s answer box
				
			}
					}});
	}

function showNavigationPane()
	{
		checkSession();
		$.ajax(
			   	{
					type:"GET",
					url:"../code/frontend_user_navigations.php?NavigationAction=display+navigator",
					cache:false,
					success:function(jsonData)	{
													
													
													jsonData  = $.parseJSON(jsonData);
													NavigatorTopLeft = jsonData.TopLeft;
													NavigatorTopRight = jsonData.TopRight;
													NavigatorBottomLeft = jsonData.BottomLeft;
													NavigatorBottomRight = jsonData.BottomRight;
													$("#Navigator").hide();
		TopLeft = "TopLeft";
		TopRight = "TopRight";
		BottomLeft = "BottomLeft";
		BottomRight = "BottomRight";

		$("#Navigator").html("<a href='#' onClick='navigateTo("+TopLeft+")'>Top Left</a>");
		$("#Navigator").html($("#Navigator").html()+"<br/><a href='#' onClick='navigateTo("+TopRight+")'>Top Right</a>");
		if((NavigatorBottomLeft=="NULL"||NavigatorBottomLeft==0)&&(NavigatorBottomRight=="NULL"||NavigatorBottomRight==0))
			{
				
				
			}
		else
			{
				$("#Navigator").html($("#Navigator").html()+"<br/><a href='#' onClick='navigateTo("+BottomRight+")'>Bottom Right</a>");
				$("#Navigator").html($("#Navigator").html()+"<br/><a href='#' onClick='navigateTo("+BottomLeft+")'>Bottom Left</a>");
			}
		$("#Navigator").fadeIn(100);
												}
				}
			);
		
	}
