import pandas as pd

def main():
    df = pd.read_csv('players.csv')
    df.drop(['ID', 'POSITION1', 'POSITION2', 'PLAYER_TYPE', 'BID_VALUE', 'BID_YEARS', 'HAS_TO', 'BID_START_DATE', 'BID_WINNER',], axis=1, inplace=True)
    id_list = []
    
    for index, row in df.iterrows():
        resultado = input(f'{row["NAME"]}: ')
        
        if resultado == 'y':
            id_list.append(str(row['NBA_ID']))
        
    ids = ', '.join(id_list)
    ids = f'({ids})'
    query = f'UPDATE players SET PLAYER_TYPE = "SIGNED" WHERE NBA_ID IN {ids}'
    
    with open("query.txt", "w") as file:
        file.write(query)

if __name__ == '__main__':
    main()