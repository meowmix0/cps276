/*
  Assignment 10 — CPS276 Gradebook on the page
  Chapter 12: DOM, events, forms, JSON

  Fill in the functions and event listeners.
  Show results on the page. Do not use console.log, Fetch, or PHP.
*/

const students = [
  { name: "Ava Chen", email: "  Ava.Chen@WCCNet.edu ", score: 94 },
  { name: "Ben Ortiz", email: "BEN.ORTIZ@wccnet.edu", score: 81 },
  { name: "Cara Singh", email: "  cara.singh@WCCNET.EDU", score: 73 },
  { name: "Drew Patel", email: " drew.patel@wccnet.edu ", score: 66 },
  { name: "Elena Brooks", email: "ELENA.BROOKS@WCCNet.edu", score: 88 }
];

const studentForm = document.querySelector("#studentForm");
const nameInput = document.querySelector("#nameInput");
const emailInput = document.querySelector("#emailInput");
const scoreInput = document.querySelector("#scoreInput");
const formError = document.querySelector("#formError");
const filterSelect = document.querySelector("#filterSelect");
const studentTableBody = document.querySelector("#studentTableBody");
const averageDisplay = document.querySelector("#averageDisplay");
const passedDisplay = document.querySelector("#passedDisplay");
const failedDisplay = document.querySelector("#failedDisplay");
const jsonPreview = document.querySelector("#jsonPreview");

function cleanEmail(rawEmail) {
  return rawEmail.trim().toLowerCase();
}

function letterGrade(score) {
  if (score >= 90) {
    return "A";
  }

  if (score >= 80) {
    return "B";
  }

  if (score >= 70) {
    return "C";
  }

  return "F";
}

function statusLabel(score) {
  if (score >= 70) {
    return "pass";
  }

  return "fail";
}

function classAverage(list) {
  let total = 0;

  for (const student of list) {
    total += student.score;
  }

  return total / list.length;
}

function getFilteredStudents(list, filterValue) {
  if (filterValue === "pass") {
    return list.filter((student) => student.score >= 70);
  }

  if (filterValue === "fail") {
    return list.filter((student) => student.score < 70);
  }

  return list;
}

function addStudentRow(student) {
  const tr = document.createElement("tr");

  const nameCell = document.createElement("td");
  nameCell.textContent = student.name;

  const emailCell = document.createElement("td");
  emailCell.textContent = cleanEmail(student.email);

  const scoreCell = document.createElement("td");
  scoreCell.textContent = student.score;

  const gradeCell = document.createElement("td");
  const gradeBadge = document.createElement("span");

  const grade = letterGrade(student.score);

  if (grade === "A") {
    gradeBadge.classList.add("badge", "text-bg-success");
  } else if (grade === "B") {
    gradeBadge.classList.add("badge", "text-bg-primary");
  } else if (grade === "C") {
    gradeBadge.classList.add("badge", "text-bg-warning");
  } else {
    gradeBadge.classList.add("badge", "text-bg-danger");
  }

  gradeBadge.textContent = grade;
  gradeCell.append(gradeBadge);

  const statusCell = document.createElement("td");
  const statusBadge = document.createElement("span");

  const status = statusLabel(student.score);

  if (status === "pass") {
    statusBadge.classList.add("badge", "text-bg-success");
  } else {
    statusBadge.classList.add("badge", "text-bg-danger");
  }

  statusBadge.textContent = status;
  statusCell.append(statusBadge);

  tr.append(
    nameCell,
    emailCell,
    scoreCell,
    gradeCell,
    statusCell
  );

  studentTableBody.append(tr);
}

function updateSummary(list) {
  averageDisplay.textContent = classAverage(list).toFixed(1);

  let passed = 0;
  let failed = 0;

  for (const student of list) {
    if (student.score >= 70) {
      passed++;
    } else {
      failed++;
    }
  }

  passedDisplay.textContent = passed;
  failedDisplay.textContent = failed;
}

function updateJson(list) {
  jsonPreview.textContent = JSON.stringify(list, null, 2);
}

function renderGradebook() {
  const filteredStudents =
    getFilteredStudents(students, filterSelect.value);

  studentTableBody.textContent = "";

  filteredStudents.forEach((student) => {
    addStudentRow(student);
  });

  updateSummary(students);
  updateJson(students);
}

studentForm.addEventListener("submit", (event) => {
  event.preventDefault();

  formError.textContent = "";

  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  const score = Number(scoreInput.value);

  if (!name) {
    formError.textContent = "Please enter a name.";
    return;
  }

  if (!email || !email.includes("@")) {
    formError.textContent =
      "Please enter an email that includes @.";
    return;
  }

  if (score < 0 || score > 100) {
    formError.textContent =
      "Please enter a score from 0 to 100.";
    return;
  }
  students.push({
    name: name,
    email: email,
    score: score
  });

  nameInput.value = "";
  emailInput.value = "";
  scoreInput.value = "";

  renderGradebook();
});

filterSelect.addEventListener("change", () => {
  renderGradebook();
});

renderGradebook();

/* 1. Why must the submit handler call event.preventDefault()? What would the user see if you left it out?
preventDefaut() stops the form from reloading the page so the new student data is not lost.
2. Why does this course use textContent for names, emails, and the JSON preview instead of innerHTML?
We use textcontent to display as plain text and to prevent the data from being used as HTML code. If it's HTML then it can be hacked to run unwated code.
3. In renderGradebook, why clear the table body and rebuild the rows from the array instead of only appending the newest student?
We clear the table body to ensure there are no duplicates.
4. Why is the students array the source of truth, rather than whatever happens to be on the page?
The array holds the main data and the page just displays the change. If the page is the source of truth then the data can be lost if the page is reloaded or changed.
5. What does JSON.stringify do here, and why show it on the page? Why would you still not store real course grades only in JavaScript?
JsonStringify converts the array to a string so it can be displayed on the page. The actual grades are stored securely and the JSON conversion is just stored in the brower memory.
*/