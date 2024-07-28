import Task from './Task.js';
import template from './task/HTMLTemplate.js';
import toggleDone from './task/toggleDone.js';

export class TaskManager {
  #tasks = [];
  #taskTable = document.getElementById('task-table');

  async get() {
    return this.#tasks;
  };

  async fetch() {
    try {
      const response = await fetch('/task');
      const items = await response.json();
      items.forEach(item => {
        this.#tasks.push(new Task(item));
      });
    } catch (error) {
      // handle error
    };
  };

  async render() {
    try {
      this.#tasks.forEach(task => {
        this.#taskTable.insertAdjacentHTML('beforeend', template(task));
      });
    } catch (error) {
      // handle error
    };
  };

  async addFunctionality() {
    try {
      this.#tasks.forEach(task => {
        toggleDone(task.id, task.toggleDone.bind(task));
      });
    } catch {
      // handle error
    };
  };
};