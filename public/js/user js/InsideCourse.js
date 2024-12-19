  //according to loftblog tut
  $('.nav li:first').addClass('active');

  var showSection = function showSection(section, isAnimate) {
    var
    direction = section.replace(/#/, ''),
    reqSection = $('.section').filter('[data-section="' + direction + '"]'),
    reqSectionPos = reqSection.offset().top - 0;

    if (isAnimate) {
      $('body, html').animate({
        scrollTop: reqSectionPos },
      800);
    } else {
      $('body, html').scrollTop(reqSectionPos);
    }

  };

  var checkSection = function checkSection() {
    $('.section').each(function () {
      var
      $this = $(this),
      topEdge = $this.offset().top - 80,
      bottomEdge = topEdge + $this.height(),
      wScroll = $(window).scrollTop();
      if (topEdge < wScroll && bottomEdge > wScroll) {
        var
        currentId = $this.data('section'),
        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
        reqLink.closest('li').addClass('active').
        siblings().removeClass('active');
      }
    });
  };

  $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
    e.preventDefault();
    showSection($(this).attr('href'), true);
  });

  $(window).scroll(function () {
    checkSection();
  });
  var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('lesson-video', {
      events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
      }
  });
}

function onPlayerReady(event) {
  // Start tracking video progress
  setInterval(checkVideoProgress, 1000); // Check every second
}

function onPlayerStateChange(event) {
  // You can handle video state changes here if needed
}

// Navigation functionality for Previous and Next buttons
$(window).scroll(function () {
  checkSection();
});

var checkSection = function checkSection() {
  $('.lesson-section').each(function () {
      var $this = $(this),
          topEdge = $this.offset().top - 80,
          bottomEdge = topEdge + $this.height(),
          wScroll = $(window).scrollTop();

      if (topEdge < wScroll && bottomEdge > wScroll) {
          var currentId = $this.attr('id'),
              reqLink = $('li.list-group-item').filter(function () {
                  return $(this).data('target') === currentId;
              });
          $('li.list-group-item.active').removeClass('active');
          reqLink.addClass('active');
      }
  });
};



var lectures = [
  {
      title: "Lesson 1: ",
      description: "Brief description of the Basics lecture content.",
      videoId: "OmtkvAp2OL0?si=QA_IgBAersk43wLC" // Short video ID 1 (accessible)
  },
  {
      title: "Lesson 2: ",
      description: "Overview of advanced topics in Computer Science.",
      videoId: "Ygboi9hrwN0?si=THecYHUrt-uyDKt_-VE" // Short video ID 2 (accessible)
  },
  {
      title: "Lesson 3: ",
      description: "Introduction to various data structures.",
      videoId: "fC46nIJOQWY?si=ji2eO5KvrYFcctED" // Short video ID 3 (accessible)
  },
  {
      title: "Lesson 4: ",
      description: "Introduction to various data structures.",
      videoId: "9aA2YAcFs0A?si=sDpM77YDCrUVe-wl" // Short video ID 3 (accessible)
  } , {
      title: "Lesson 5: ",
      description: "Introduction to various data structures.",
      videoId: "yH4N5LdK5WY?si=VVMtPPFstoh6eGIc" // Short video ID 3 (accessible)
  }  ,{
      title: "Lesson 6: ",
      description: "Introduction to various data structures.",
      videoId: "rJYSqQoCyjQ?si=QF5CBdDE0M5GGQt-" // Short video ID 3 (accessible)
  } 
];
var currentLectureIndex = 0;

var loadLecture = function (index) {
$('#lesson-title').text(lectures[index].title);
$('#lesson-description').text(lectures[index].description);
$('#lesson-video').attr('src', "https://www.youtube.com/embed/" + lectures[index].videoId);
$('li.list-group-item').removeClass('active');
$('li.list-group-item').eq(index).addClass('active');

currentLectureIndex = index; // Update the current index
};

document.getElementById('nextButton').onclick = function () {
if (currentLectureIndex < lectures.length - 1) {
  loadLecture(currentLectureIndex + 1);
}
};

document.getElementById('prevButton').onclick = function () {
if (currentLectureIndex > 0) {
  loadLecture(currentLectureIndex - 1);
}
};

// Check video progress and mark as done
var videoDuration = 0;

function checkVideoProgress() {
if (player && player.getCurrentTime && player.getDuration) {
var currentTime = player.getCurrentTime();
videoDuration = player.getDuration();

// Log current time and duration for debugging
console.log(`Current Time: ${currentTime}, Duration: ${videoDuration}`);

// Check if 80% of the video has been watched
if (currentTime >= 0.8 * videoDuration) {
  markAsDone(currentLectureIndex);
}
}
}
function onPlayerReady(event) {
// Start tracking video progress
setInterval(checkVideoProgress, 1000); // Check every second
}

function markAsDone(index) {
var lessonItem = $('li.list-group-item').eq(index);
if (!lessonItem.hasClass('done')) {
lessonItem.addClass('done');
lessonItem.append(' ✔'); // Append a check mark
console.log(`Lesson ${index + 1} marked as done.`);
}
}



// Initial load
loadLecture(currentLectureIndex);

document.getElementById("discussionForm").addEventListener("submit", function (e) {
e.preventDefault();

// Get user inputs
const userName = document.getElementById("userNameInput").value.trim();
const userComment = document.getElementById("userCommentInput").value.trim();

if (userName && userComment) {
  addDiscussionComment(userName, userComment);
  
  // Clear the input fields after posting
  document.getElementById("userNameInput").value = '';
  document.getElementById("userCommentInput").value = '';
}
});

function addDiscussionComment(userName, userComment) {
// Create elements
const commentDiv = document.createElement("div");
commentDiv.classList.add("discussion-comment");

const userElement = document.createElement("div");
userElement.classList.add("comment-username");
userElement.textContent = userName;

const textElement = document.createElement("div");
textElement.classList.add("comment-text");
textElement.textContent = userComment;

// Append elements
commentDiv.appendChild(userElement);
commentDiv.appendChild(textElement);
document.getElementById("discussionCommentsList").appendChild(commentDiv);
}
$(document).ready(function () {
// Handle comment submission
$('#discussionForm').on('submit', function (e) {
  e.preventDefault();
  
  const username = $('#userNameInput').val();
  const commentText = $('#userCommentInput').val();
  
  // Create the comment element
  const commentDiv = $('<div class="discussion-comment"></div>');
  commentDiv.append(`<div class="comment-username">${username}</div>`);
  commentDiv.append(`<div class="comment-text">${commentText}</div>`);
  
  // Add like, dislike, and reply buttons
  const likeButton = $('<button class="like-button">👍 Like</button>');
  const dislikeButton = $('<button class="dislike-button">👎 Dislike</button>');
  const replyButton = $('<button class="reply-button">💬 Reply</button>');
  
  const repliesContainer = $('<div class="replies-container"></div>');

  // Append buttons to comment
  commentDiv.append(likeButton);
  commentDiv.append(dislikeButton);
  commentDiv.append(replyButton);
  commentDiv.append(repliesContainer);

  // Update comment list
  $('#discussionCommentsList').append(commentDiv);

  // Clear input fields
  $('#userNameInput').val('');
  $('#userCommentInput').val('');

  // Handle like button click
  likeButton.on('click', function () {
      alert(`${username} liked this comment!`);
      // You can implement further like functionality here
  });

  // Handle dislike button click
  dislikeButton.on('click', function () {
      alert(`${username} disliked this comment!`);
      // You can implement further dislike functionality here
  });

  // Handle reply button click
  replyButton.on('click', function () {
      const replyInput = $('<input type="text" class="reply-input" placeholder="Your reply..." />');
      const replySubmitButton = $('<button class="reply-submit">Post Reply</button>');
      
      repliesContainer.append(replyInput);
      repliesContainer.append(replySubmitButton);
      
      // Handle reply submission
      replySubmitButton.on('click', function () {
          const replyText = replyInput.val();
          if (replyText) {
              const replyDiv = $('<div class="reply"></div>');
              replyDiv.text(`${username} replied: ${replyText}`);
              repliesContainer.append(replyDiv);
              replyInput.val(''); // Clear reply input
          }
      });
  });
});
});