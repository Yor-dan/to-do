import taskContainer from './Container.js';

class TaskManager {
  constructor(container) {
    this.container = container;
    Object.seal(this);
  };
  
  #toShow = 'all';
  get toShow() {
    return this.#toShow;
  };

  showAll() {
    this.#toShow = 'all';
    this.container.items.forEach(task => task.show());
  };

  hideAll() {
    this.container.items.forEach(task => task.hide());
  };

  showCompleted() {
    this.#toShow = 'completed';
    this.container.items.forEach(task => {
      task.hide();
      if (task.isDone === '1') {
        task.show();
      };
    });
  };

  showIncomplete() {
    this.#toShow = 'incomplete';
    this.container.items.forEach(task => {
      task.hide();
      if (task.isDone === '0') {
        task.show();
      };
    });
  };
};

export default new TaskManager(taskContainer);