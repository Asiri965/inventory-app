import DashboardController from './DashboardController'
import ItemController from './ItemController'
import InventoryController from './InventoryController'
import Settings from './Settings'
const Controllers = {
    DashboardController: Object.assign(DashboardController, DashboardController),
ItemController: Object.assign(ItemController, ItemController),
InventoryController: Object.assign(InventoryController, InventoryController),
Settings: Object.assign(Settings, Settings),
}

export default Controllers