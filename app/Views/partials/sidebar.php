<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
  <span class="sr-only">Open sidebar</span>
  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
  </svg>
</button>

<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <a href="https://flowbite.com/" class="flex items-center pl-2.5 mb-5">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-7" alt="Flowbite Logo" />
      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">To-do</span>
    </a>
    <ul class="space-y-2 font-medium">
      <li>
        <a all list-toggle-color class="cursor-pointer flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-blue-500 dark:hover:bg-gray-700">All</a>
      </li>
      <li>
        <a unfinished list-toggle-color class="cursor-pointer flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Unfinished</a>
      </li>
      <li>
        <a done list-toggle-color class="cursor-pointer flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Done</a>
      </li>
      <li>
        <a href="/sign-out" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
          <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
          </svg>
          <span class="flex-1 ml-3 whitespace-nowrap">Sign Out</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

<script>
  // change color of category btn
  const toggleColorBtns = document.querySelectorAll('a[list-toggle-color]');
  toggleColorBtns.forEach(toggleColorBtn => {
    toggleColorBtn.addEventListener('click', () => {
      toggleColorBtns.forEach(btn => {
        btn.classList.remove('dark:text-blue-500');
        btn.classList.add('dark:text-white');
      });
      toggleColorBtn.classList.remove('dark:text-white');
      toggleColorBtn.classList.add('dark:text-blue-500');
    });
  });
</script>

<script>
  const getAllTasks = document.querySelector('a[all]');
  getAllTasks.addEventListener('click', () => {
    localStorage.setItem('state', 'all');
    renderTasks();
  })
</script>

<script>
  const getUnfinishedTasks = document.querySelector('a[unfinished]');
  getUnfinishedTasks.addEventListener('click', () => {
    localStorage.setItem('state', 'unfinished');
    renderTasks(0);
  })
</script>

<script>
  const getDoneTasks = document.querySelector('a[done]');
  getDoneTasks.addEventListener('click', () => {
    localStorage.setItem('state', 'done');
    renderTasks(1);
  })
</script>