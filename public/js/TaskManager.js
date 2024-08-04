import Task from './Task.js';
import toggleDone from './task/toggleDone.js';

export class TaskManager {
  #tasks = [];

  get tasks() {
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

  render() {
    this.#tasks.forEach(task => task.render());
  };

  addFunctionality() {
    this.#tasks.forEach(task => {
      toggleDone(task.id, task.toggleDone.bind(task));
    });
  };
};