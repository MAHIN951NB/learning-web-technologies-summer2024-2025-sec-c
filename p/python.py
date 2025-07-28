import heapq

def uniform_cost_search(graph, start, goal):
    # Priority queue to store (cost, node) tuples
    priority_queue = [(0, start)]
    # Dictionary to store the cost of the shortest path found so far to each node
    # and the parent node for path reconstruction
    visited = {start: (0, None)}

    while priority_queue:
        current_cost, current_node = heapq.heappop(priority_queue)

        # If the goal is reached, reconstruct and return the path
        if current_node == goal:
            return current_cost, reconstruct_path(visited, start, goal)

        # Explore neighbors
        for neighbor, edge_cost in graph.get(current_node, []):
            new_cost = current_cost + edge_cost

            # If a shorter path to the neighbor is found or it's a new node
            if neighbor not in visited or new_cost < visited[neighbor][0]:
                visited[neighbor] = (new_cost, current_node)
                heapq.heappush(priority_queue, (new_cost, neighbor))

    return float('inf'), []  # Goal not reachable

def reconstruct_path(visited, start, goal):
    path = []
    current = goal
    while current is not None:
        path.append(current)
        current = visited[current][1]
    path.reverse()
    return path

# Example Usage:
# Represent the graph as an adjacency list with costs
graph = {
    'A': [('B', 1), ('C', 5)],
    'B': [('D', 3), ('E', 2)],
    'C': [('F', 1)],
    'D': [('G', 4)],
    'E': [('G', 6)],
    'F': [('G', 2)]
}

start_node = 'A'
goal_node = 'G'

cost, path = uniform_cost_search(graph, start_node, goal_node)

if path:
    print(f"Least cost path from {start_node} to {goal_node}: {path}")
    print(f"Total cost: {cost}")
else:
    print(f"Goal {goal_node} not reachable from {start_node}.")