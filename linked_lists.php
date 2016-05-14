<?php $currentPage = "notes"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("head.php"); ?>
	</head>

	<body>
		<?php include("header.php");?>

		<!--Body paragraph-->
		<div id="inner" class="container">
      <div class="list-group">
        <a href="#intro" class="list-group-item">Intro</a>
        <a href="#insert" class="list-group-item">Insertion</a>
        <a href="#" class="list-group-item">Third item</a>
      </div>


			<div class="text-center page-header">
				<h1 id="intro">Linked List</h1>
			</div>
			<div class="body-paragraph" class="text-left">
				<p>
					Say you want to create a Pokemon class. Now each Pokemon is unique and has different features that you want to include
					 in that class. Maybe some attack moves, ability and nature, if it is shiny and even EV and IV if you are into competitive battling.
					  Now imaging that Pokemon is in a line waiting to see the new Pokemon movie (or in their case, just a movie). Now you don't know every Pokemon in that line but you can see the Pokemon that is right after you. Now you can't really have another Pokemon as you do not know what that Pokemon has yet but what you can do is Point to that Pokemon.</p>
				<p>This is essentialy what a linked list is. It is a series of classes where each instance of the class has a pointer to the next instance of that class. Now it has to be a pointer because when declaring a class, you must know the size of every variable inside that class and because you are still declaring the class, you would not be able to know the full size of that class. But you can declare a pointer of your own class because a pointer is a fixed size thus solving the problem from before. This is the basic instance of a linked list:</p>
        <pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
class Node{ //Node is just a single instance of class
public:
   //Information that you want to keep in this instance
   int value;

   //Pointer to the next instance
   Node * next;
};
        </code></pre>
        <p> Now in most cases, linked lists are created in the heap because it is easier to pass around a linked lists in the heap than it is in the stack. This is because when the stack is popped, everything is the stack is lost where as it is easier to keep track of linked lists in heaps (especially important when passing linked lists to functions).</p>
        <p> Now to make a linked list is very simple. It is a 2 step process. First, you have to allocate memory in the heap to store the instance. Second, assign values to your instance. To do this, you would need to create a constructor for the node class.</p>
        <pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
class Node{
public:
   int value;
   Node * next;

   //Constructor for the Node class
   Node(int number, Node * newNode):value(number),next(newNode){}
};

int main(){
   //Creates an empty node
   Node * node1 = NULL;

   //Creates a new node with the value of 2 and nothing else after it
   Node * node2 = new Node(2,NULL);

   //Creates a new node with the value of 2 and points to another node with the value of 3
   Node * node3 = new Node(2, new Node(3,NULL));

   //REMEMBER TO DELETE YOUR MEMORY!!!!!!!!!!
   delete node2;
   delete node3->next;
   delete node3;
}
        </code></pre>
        <p>Here is the wrapper for a linked list, you will see why we need it at the end of the insertion section</p>
        <pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
class LinkedList{
public:
   Node * tail;
   LinkedList():tail(NULL){}
   ~LinkedList(){
      while(tail != NULL){
         Node * newTail = tail->next;
         delete tail;
         tail = newTail;
      }
   }
}
        </code></pre>
        <pre class="text-primary">In my definition, head also means last which also means you were the first to be added in the list
        this is because when you are added first, you are at the head of the line, but the last person to see when you start from the back
        like in a linked list. Thus tail also means first. It is really hard to explain so I will draw this out.</pre>

        <div class="text-center page-header">
          <h1 id="insert">Insertion</h1>
        </div>
        <p>
Now lets say you want an insert function where you given the list and a value that you want to insert.Now lets say you want an insert function where you given the list and a value that you want to insert.
Now there could be several ways for you to insert another value to the list. You could add it to the front (first) of the list, back (last) of the list or if you are really daring, insert in order. Depending on what you need, there are advantages and disadvantages for each type of insert, but we will talk about that later. The method is simple for insertion in a list, create a new instance and put it where you want it to be.
Here is the insert function for inserting the new value into the back of the list.</p>
				<pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
Node * insertBack(int val, Node * list){
   //Create a new node but instead of making the next NULL, you make it the rest of the list
   Node * n = new Node(val, list);
   //Now all you need to know is return the new start of the list
    return n;
}</code></pre>
				<p>
Analysis: This will always be in constant time (O(1)) because we know where the back of the list is. So the only thing we need to do is point there and tell people that we are the new back of the list. Now there is a problem with this code and that is what happens if 2 different values sees the back of the list. Ex:
				<pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
Node * originalLine = new Node(2,NULL);
Node * lineOne = new Node(3,originalLine);
Node * lineTwo = new Node(4,originalLine);
				</code></pre>
<p> As you can see, the line DIVERGED into 2 lines!!! That is not a proper line nor is that a proper linked list. There is a way to fix this but I'll talk about that later.</p>

<p>The next type of insert is where you insert the new instance in order with a parameter of your choosing. Here is an example, pretend you are in grade 2 again. It is picture day and they want you to line up based on your height. The new instance is you trying to jump into the line and the parameter is the height of all the students. Here is the code for this type of insertion:</p>

				<pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
Node * insertOrder(int val, Node * list){
   //Need to check if the you are the first one in the list
   if(list == NULL){
      return new Node(val, NULL);
   } 
   //Now we need to check to see if you are smaller than the last value in that list
   else if (val <= list->value){
      //Because you are smaller, everything past this point will be bigger than you, 
      //thus you stop here, this case should only happen on the first call when you are the smallest value in that list
      return new Node(val, list);
   }
   //Now you check to see if you are biggest value in that list by checking to see if there are anymore in front of you
   else if (list->next == NULL){
      //Because there is nothing bigger than you, you tell the current biggest thing that you are bigger
      list->next = new Node(val, NULL);
      //You have to return NULL because you did not change who the last person is
      //Note: you would have to make an if condition with this call to tell whoever is calling it that the smallest has not changed
      return NULL;
   }
   //Now you need to check to see if you are bigger than the current node but smaller than the node after that
   else if (val > list->value && val <= list->next->value){
      //Since you know that you are between these two values, all we need to do now is create a new instance between these values
      list->next = new Node(val,list->next);
      return NULL;
   }
   //Else move to the next node because the value does not belong here
   else {
      return insertOrder(val,list->next);
   }
}
				</code></pre>
				<p>Analysis: This will at worst only once through the entire list and thus making it linear time O(n). 
				That is not bad because you are inserting, you do not want to look at the whole list over and over again because it would be redundant. 
				However we can do better. In fact we can do alot better than this because this is really ugly code. The fact that we have to write an 
				if statement to go along this code is really bad. An easier way to write the code is using a wrapper function 
        that wraps around this piece of code. By using a wrapper, we can effectively return the tail of the list at all times
        without relying on the user to check if it is the actual tail. Here is the example:
				<pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
//This is the actual function where we do most of the work
//This has an extra parameter where it will always keep track of where the tail is
Node * insertOrder(int val, Node * list, Node * tail){
   //Still need to check if the list is NULL
   //But we can combine that with checking to see if the new value
   //is smaller than the next value because list must either be NULL or bigger than the current value
   //both of which can be places after the current value
   if (list == NULL || val <= list->value){
      return new Node(val, list);
   }
   //Now we check for the same conditions as before
   else if (list->next == NULL){
      //Because there is nothing bigger than you, you tell the current biggest thing that you are bigger
      list->next = new Node(val, NULL);
      return tail;
   } else if (val > list->value && val <= list->next->value){
      list->next = new Node(val,list->next);
      return tail;
   } else {
      return insertOrder(val,list->next, tail);
   }
}

//this now becomes a wrapper function where it returns the function that is actually working 
//but keeps the same parameters as the previous function to keep it consistent
//Keep in mind that you must either forward declare the function you are wrapping for the wrapper to work
Node * insertOrderWrapper(int val, Node * list){
  return insertOrder(val, list, list);
}
				</code></pre>
        <p>Analysis: This function has the same speed the previous function with O(n) time.
        But the difference between this function and the previous function is that it will not return NULL when the 
        insertion is after the tail. This is much better than previous function because it does not rely on the user
        to create an if statement for you to insert. And since I and many others are pretty forgetful, this function is
        definite better than the previous function. <br> Now most people would just be satisfied by now but we can do much better.
        You see, when a function is called, it uses memory and because recursion is calling the same function over and over again, it
        will use a lot of memory. Instead, we can use an iterative approact to this problem by using while loops. By doing this,
        we would not have to create new memory for each function call and thus saving space. Here is the code:</p>
        <pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
//Same function call with the same parameters :D
Node * insertOrder(int val, Node * list){
   //Still need to check for an empty list or if the it is smaller than the rest of the list
   if(list == NULL || val <= list->value ){
      return new Node(val,list);
   } else {
     //Create a temporary list that points to the tail of the given list
     //we will iterate through this rather than the original list
     Node * tempList = list;
     while (true){
        if(tempList->next->value > val){
           Node * newNode = new Node(val, tempList->next);
           tempList->next = newNode;
           break;
        } else {
           tempList = tempList->next;
           if (tempList->next == NULL){
              tempList->next = new Node(val,NULL);
              break;
           }
        }
     }
     return list;
   }
}
        </code></pre>
        <p> As you can see, there is no recursion and thus no extra memory is created because of a
        function call and is better than the previous function.</p>
        <p> The final way to insert is to insert it right at its head, in front of everyone else. Now the simple way to do this
        is by iteratively checking to see if there is another instance ahead of itself, if there is, ask that instance, if not
        then we are at the head. Here is the code:</p>
        <pre class="prettyprint lang-cpp text-left"><code class="language-cpp">
Node * insertFront(int val, Node * list){
   //Create the new instance, next will always be null as it will be the new head
   Node * newNode = new Node (val, NULL);

   //Checks if the list is empty
   if (list == NULL){
      //Returns the new instance because there is only one
      return newNode;
   } else {
      //If the list is not empty, find the head of the list

      //First, create a temporary node that points to the head
      Node * temp = list;

      //Next Iterate through the list until it hits the head
      while (temp->next != NULL){
         temp = temp->next;
      }

      //Finally tell that head there will be something next to it thus creating the new head
      temp->next = newNode;

      //return the tail of the head
      return list;
   }
}
      </code></pre>
      <p>Analysis: Time for this algorithm is O(n) as all you are going to each node in the list until you hit the head</p>
      <p>This is an ok time for inserting at the head but we could do better. Think about it, the head will never change position,
      so rather than looping through the entire list, why not just point directly at the head of the list and insert when needed</p>
			</div>
		</div>

	</body>

</html> 