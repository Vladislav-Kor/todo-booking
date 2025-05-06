<?php

/** @var yii\web\View $this */

$this->title = 'Календарь бронирования';
?>
<div class="container">
    <div id="calendar"></div>
</div>
<script>
let $calendar = document.querySelector('#calendar')
let days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс']
days.forEach(e => {
  let day = document.createElement('div')
  day.textContent = e
  day.className = 'name'
  $calendar.appendChild(day)
})
for (let i = 1; i < 36; i++) {
  let day = document.createElement('div')
  let dayNum = i - 5
  let isEmpty = dayNum < 1

  day.className = 'block' + (isEmpty ? ' empty' : '')
  day.textContent = isEmpty ? '' : dayNum
  $calendar.appendChild(day)
}
$calendar.addEventListener('click', e => {
  if(e.target.matches('[class="block"]')) {
    e.target.classList.add('active')
  }
})
</script>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, 'Segoe UI';
}
#calendar {
  display: grid;
  grid-template-columns: repeat(7, auto);
}
.block {
  height: 3.125em;
  margin: .125em;
  display: grid;
  background-color: rgb(221, 255, 204);
  align-items: center;
  justify-content: center;
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
}
.name, .block {
  text-align: center;
}

.name {
  font-weight: 700;
}

.empty {
  background-color: rgb(247, 247, 247);
}

.active {
  background-color: rgb(255, 192, 189);
}
</style>