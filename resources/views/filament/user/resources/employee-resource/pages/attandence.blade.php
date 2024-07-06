<x-filament-panels::page>
   
    <button id="attendanceButton" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Start</button>
  
    <div id="startTimeDisplay"></div>
    <div id="endTimeDisplay"></div>
    <div id="durationDisplay"></div>
    <div>
        <input type="hidden" name="employee_id" value="{{ $this->record->id }}" id="employee_id">
    </div>

    <div>
        {{ $this->table }}
    </div>
    
   
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
             const button = document.getElementById('attendanceButton');
             const startTimeDisplay = document.getElementById('startTimeDisplay');
             const endTimeDisplay = document.getElementById('endTimeDisplay');
             const durationDisplay = document.getElementById('durationDisplay');
             const employeeId =  document.getElementById('employee_id').value;
 
             let startTime = localStorage.getItem('startTime') ? new Date(localStorage.getItem('startTime')) : null;
             let isTiming = localStorage.getItem('isTiming') === 'true';
             let timerInterval;
 
             if (isTiming) {
                 button.textContent = 'Stop';
                 startTimeDisplay.textContent = `Start Time: ${startTime.toLocaleTimeString()}`;
                 timerInterval = setInterval(updateTimer, 1000);
             }
 
             button.addEventListener('click', (event) => {
                 event.preventDefault();
                 if (!isTiming) {
                     startTime = new Date();
                     localStorage.setItem('startTime', startTime.toISOString());
                     startTimeDisplay.textContent = `Start Time: ${startTime.toLocaleTimeString()}`;
                     endTimeDisplay.textContent = '';
                     durationDisplay.textContent = '';
                     button.textContent = 'Stop';
 
                     timerInterval = setInterval(updateTimer, 1000);
 
                     isTiming = true;
                     localStorage.setItem('isTiming', isTiming);
                 } else {
                     clearInterval(timerInterval);
 
                     const endTime = new Date();
                     const duration = endTime - startTime;
                     const seconds = Math.floor((duration / 1000) % 60);
                     const minutes = Math.floor((duration / (1000 * 60)) % 60);
                     const hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
 
                     endTimeDisplay.textContent = `End Time: ${endTime.toLocaleTimeString()}`;
                     durationDisplay.textContent = `Duration: ${hours}h ${minutes}m ${seconds}s`;
 
                     const attendanceData = {
                         startTime: startTime.toISOString().slice(0, 19).replace('T', ' '),
                         endTime: endTime.toISOString().slice(0, 19).replace('T', ' '),
                         duration: `${hours}h ${minutes}m ${seconds}s`,
                         employeeId : employeeId,
                     };
 
                     axios.post('/attendance', attendanceData, {
                         headers: {
                             'Content-Type': 'application/json',
                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                         }
                     })
                     .then(response => {
                         //console.log(response.data);
                         location.reload();
                     })
                     .catch(error => {
                         //console.error('Error:', error);
                     });
 
                     button.textContent = 'Start';
                     isTiming = false;
                     localStorage.setItem('isTiming', isTiming);
                     localStorage.removeItem('startTime');
                 }
             });
 
             function updateTimer() {
                 const now = new Date();
                 const elapsed = now - startTime;
                 const seconds = Math.floor((elapsed / 1000) % 60);
                 const minutes = Math.floor((elapsed / (1000 * 60)) % 60);
                 const hours = Math.floor((elapsed / (1000 * 60 * 60)) % 24);
 
                 button.textContent = `Stop (${hours}h ${minutes}m ${seconds}s)`;
             }
         });
     </script>
</x-filament-panels::page>
